<?php

use App\Http\Controllers\Public\ChannelsListController;
use App\Http\Controllers\Public\GetChannelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function() {
    Route::get("/i/show/{client_uuid}", ChannelsListController::class);
    Route::get("/i/get/{client_uuid}/{channel_uuid}", GetChannelController::class);
});

