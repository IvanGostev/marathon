<?php

use App\Http\Controllers\Admin\BookAdminController;
use App\Http\Controllers\Admin\NoteAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\VideoAdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('notes')->name('note.')->controller(NoteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{note}/view', 'view')->name('view');
        Route::post('/store', 'store')->name('store');
    });
    Route::prefix('videos')->name('video.')->controller(VideoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
    Route::prefix('comments')->name('comment.')->controller(CommentController::class)->group(function () {
        Route::post('/store', 'store')->name('store');

    });


});
//, 'admin'
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('users')->name('user.')->controller(UserAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
    Route::prefix('notes')->name('note.')->controller(NoteAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{note}/approve', 'approve')->name('approve');
        Route::post('/{note}/reject', 'reject')->name('reject');
    });
    Route::prefix('books')->name('book.')->controller(BookAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::delete('/{book}/delete', 'delete')->name('delete');
    });
    Route::prefix('videos')->name('video.')->controller(VideoAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::delete('/{video}/delete', 'delete')->name('delete');
    });
});

require __DIR__ . '/auth.php';
