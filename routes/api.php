<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/genres', [ApiController::class, 'genres']);
Route::get('/genre', [ApiController::class, 'genre']);
Route::get('/movies', [ApiController::class, 'movies']);
Route::get('/movie/{id}', [ApiController::class, 'movie']);
