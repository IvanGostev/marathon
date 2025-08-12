<?php

use App\Http\Controllers\Admin\BookAdminController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\NoteAdminController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\VideoAdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    // Главная страница
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Отчеты и комментарии к ним
    Route::prefix('notes')->name('note.')->controller(NoteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{note}/view', 'view')->name('view');
        Route::post('/store', 'store')->name('store');
    });
    Route::prefix('comments')->name('comment.')->controller(CommentController::class)->group(function () {
        Route::post('/store', 'store')->name('store');
    });

    // Блог
    Route::prefix('posts')->name('post.')->controller(PostController::class)->group(function () {
        Route::get('/{user}/blog', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{post}/view', 'view')->name('view');
        Route::post('/store', 'store')->name('store');
    });

    // Видео
    Route::prefix('videos')->name('video.')->controller(VideoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    // Рейтинг
    Route::prefix('ratings')->name('rating.')->controller(RatingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
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
    Route::prefix('posts')->name('post.')->controller(PostAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{post}/approve', 'approve')->name('approve');
        Route::post('/{post}/reject', 'reject')->name('reject');
    });
    Route::prefix('comments')->name('comment.')->controller(CommentAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{comment}/approve', 'approve')->name('approve');
        Route::post('/{comment}/reject', 'reject')->name('reject');
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
