<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::redirect('/blog', '/blog/page/1');

Route::get('/blog/page/{page?}', [BlogController::class, 'index'])->name('blog.index');

Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::post('/blog/{slug}/comments', [\App\Http\Controllers\CommentController::class, 'store']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
