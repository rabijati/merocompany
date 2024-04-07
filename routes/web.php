<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::Class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //post
    Route::get('/admin/post/list', [PostController::class, 'view'])->name('post.view');
    Route::get('/admin/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/admin/post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/admin/post/edit/{postid}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/admin/post/edit/{postid}', [PostController::class, 'update'])->name('post.update');
    Route::get('/admin/post/edit/{postid}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/admin/post/viewpost/{postid}', [PostController::class, 'viewpost'])->name('post.viewpost');
    Route::post('/admin/post/addComment', [PostController::class, 'commentStore'])->name('comment.store');

    

});

require __DIR__.'/auth.php';
