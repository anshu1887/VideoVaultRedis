<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Redis;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::get('/videos/edit/{id}', [VideoController::class, 'edit'])->name('videos.edit');
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.watch');
Route::post('/store', [VideoController::class, 'store'])->name('video.store');
Route::post('/update/{id}', [VideoController::class, 'update'])->name('video.update');
Route::get('/watch/{id}', function ($id) {
    return "Video ID: " . $id;
})->name('video.watch');
Route::get('/trendings', [VideoController::class, 'trending'])->name('videos.trending');



Route::get('/redis-test', function () {
    try{
        $ping = Redis::ping();

        Redis::set('project', 'VideoVault');

        $name = Redis::get('project');

        Redis::setex('temp', 10, 'This is a temporary value');

        return "Ping Response: {$ping} <br> SetName: {$name} <br> SetEx: Temporary value set for 10 seconds.";

    } catch(Exception $e) {
        return "Redis Error" . $e->getMessage();   }
});