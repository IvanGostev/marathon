<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutualAidRequest;
use App\Models\Coach;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class MutualAidController extends Controller
{
    public function index(Request $request)
    {
        $query = MutualAidRequest::with('user')->latest();

        if ($request->has('type') && in_array($request->type, ['coach', 'partner'])) {
            $query->where('type', $request->type);
        }

        $requests = $query->get();

        $userPartnerRequest = MutualAidRequest::where('user_id', auth()->id())->where('type', 'partner')->first();
        $userCoachRequest = MutualAidRequest::where('user_id', auth()->id())->where('type', 'coach')->first();

        // Connections where I am the helper
        $myPartnering = Coach::where('leader', auth()->id())->where('type', 'partner')->where('status', 'active')->get();
        $myCoaching = Coach::where('leader', auth()->id())->where('type', 'coach')->where('status', 'active')->get();

        // Connections where someone is helping me
        $acceptedPartner = Coach::where('venerable', auth()->id())->where('type', 'partner')->where('status', 'active')->first();
        $acceptedCoach = Coach::where('venerable', auth()->id())->where('type', 'coach')->where('status', 'active')->first();

        if ($request->ajax()) {
            return view('partials.mutual-aid-table', compact('requests'))->render();
        }

        return view('mutual-aid', compact(
            'requests',
            'userPartnerRequest',
            'userCoachRequest',
            'myPartnering',
            'myCoaching',
            'acceptedPartner',
            'acceptedCoach'
        ));
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'type' => 'required|in:coach,partner',
            'message' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
        ]);

        // Check for existing request of this type
        $existing = MutualAidRequest::where('user_id', auth()->id())->where('type', $request->type)->first();
        if ($existing) {
            return back()->with('error', 'У вас уже есть активный запрос этого типа.');
        }

        $filePaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePaths[] = $file->store('mutual-aid-requests', 'public');
            }
        }

        $aidRequest = MutualAidRequest::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'message' => $request->message,
            'file_paths' => $filePaths,
        ]);

        // Notify eligible users
        $eligibleUsers = [];
        if ($request->type === 'coach') {
            // Only active (approved) coaches with free spots
            $eligibleUsers = User::where('id', '!=', auth()->id())
                ->get()
                ->filter(fn($u) => $u->can_be_coach());
        } else {
            // Only active partners with free spots
            $eligibleUsers = User::where('id', '!=', auth()->id())
                ->get()
                ->filter(fn($u) => $u->can_be_assistant());
        }

        $typeLabel = $request->type === 'coach' ? 'коуча' : 'напарника';
        foreach ($eligibleUsers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'system',
                'message' => "Появился новый запрос на поиск {$typeLabel}.",
                'comment_id' => null
            ]);
        }

        return back()->with('success', 'Ваша заявка успешно отправлена.');
    }

    public function toggleStatus(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:coach,partner',
                'status' => 'required|boolean',
                'contact_info' => 'nullable|string|max:255',
                'max_count' => 'nullable', // Allow flexibility, cast later
            ]);

            $user = auth()->user();
            $field = $request->type === 'coach' ? 'is_coach' : 'is_assistant';

            // Logic:
            // Partner: ON -> 'active', OFF -> 'false'
            // Coach: ON -> 'pending', OFF -> 'false'

            if ($request->status == 0) {
                $newStatus = 'false';
                $message = 'Статус отключен.';
            } else {
                // Turning ON
                if ($request->type === 'partner' || $user->role === 'admin') {
                    $newStatus = 'active'; // Auto-approve for partners and ALL admins
                    $message = $request->type === 'partner'
                        ? 'Статус "Напарник" активирован.'
                        : 'Статус "Коуч" активирован (Админ).';

                    if ($request->has('max_count')) {
                        $field_limit = $request->type === 'coach' ? 'max_coach_count' : 'max_assistant_count';
                        $user->$field_limit = $request->max_count;
                    }
                    if ($request->type === 'coach' && $request->has('contact_info')) {
                        $user->contact_info = $request->contact_info;
                    }
                    $user->save();
                } else {
                    $newStatus = 'pending'; // Pending for normal coach
                    $message = 'Ваша заявка принята. Администратор свяжется с вами в ближайшее время.';

                    if ($request->has('contact_info')) {
                        $user->contact_info = $request->contact_info;
                    }
                    if ($request->has('max_count')) {
                        $user->max_coach_count = $request->max_count;
                    }
                    $user->save();
                }
            }

            $user->update([$field => $newStatus]);

            return response()->json([
                'success' => true,
                'status' => $newStatus,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }
}
