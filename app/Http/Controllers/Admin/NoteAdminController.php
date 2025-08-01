<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NoteAdminController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->all()['type'] ?? 'all';
        if ($type == 'moderation') {
            $notes = Note::where('status', 'moderation')->get();
        } else {
            $notes = Note::all();
        }
        return view('admin.note.index', compact('notes','type'));
    }
    public function approve(Note $note, Request $request): RedirectResponse
    {

        $note['status'] = 'approve';
        $note->update();
        return back();
    }
    public function reject(Note $note, Request $request): RedirectResponse
    {
        $note['status'] = 'reject';
        $note->update();
        return back();
    }
}
