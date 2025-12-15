<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.watch');



Route::post('/store', [VideoController::class, 'store'])->name('video.store');
Route::get('/watch/{id}', function ($id) {
    return "Video ID: " . $id;
})->name('video.watch');