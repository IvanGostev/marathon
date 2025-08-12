<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BookAdminController extends Controller
{
    public function index(Request $request): View
    {

        $books = Book::all();
        return view('admin.book.index', compact('books'));
    }
    public function store(Request $request): RedirectResponse
    {
        $arr = $request->all();
        unset($arr['_token']);
        Book::firstOrCreate($arr);
        return back();
    }
    public function delete(Book $book): RedirectResponse
    {
        $book->delete();
        return back();
    }

}
