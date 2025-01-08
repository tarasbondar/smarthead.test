<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function() {

    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::get('/movies', [MoviesController::class, 'index'])->name('admin.movies.index');
    Route::get('/movie/add', [MoviesController::class, 'add'])->name('admin.movies.add');
    Route::get('/movie/edit/{id}', [MoviesController::class, 'edit'])->name('admin.movies.edit');
    Route::post('/movie/store', [MoviesController::class, 'store'])->name('admin.movies.store');
    Route::post('/movie/change-status', [MoviesController::class, 'changeStatus'])->name('admin.movies.change-status');
    Route::delete('/movie/destroy', [MoviesController::class, 'destroy'])->name('admin.movies.destroy');

    Route::get('/genres', [GenresController::class, 'index'])->name('admin.genres.index');
    Route::get('/genre/add', [GenresController::class, 'add'])->name('admin.genres.add');
    Route::get('/genre/edit/{id}', [GenresController::class, 'edit'])->name('admin.genres.edit');
    Route::post('/genre/store', [GenresController::class, 'store'])->name('admin.genres.store');
    Route::delete('/genre/destroy', [GenresController::class, 'destroy'])->name('admin.genres.destroy');

})->middleware(['auth', 'isAdmin']);


require __DIR__.'/auth.php';
