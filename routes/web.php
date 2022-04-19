<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\MiningController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Api\Auth\RegistrationController;

Route::get('/', [PageController::class, 'index']);
Route::get('/mining' , [MiningController::class , 'index']);
Route::get('/about' , [AboutController::class , 'index']);
Route::get('/statistic' , [StatisticController::class , 'index']);
Route::get('/contact' , [ContactController::class , 'index']);
Route::post('/contact' , [ContactController::class , 'message']);
Route::get('/verify' ,[RegistrationController::class , 'verify']);
Route::get('/seed' ,[RegistrationController::class , 'seedAmin']);

Route::get('widget/{id}', function ($id) {
    return view('pages.widget', ['id' => $id]);
});
Route::get('btc_widget', function () {
    return view('pages.widget_btc');
});

Route::any(
    '{query}',
    function () {
        return view('pages.base');
    }
)->where('query', '.*');
