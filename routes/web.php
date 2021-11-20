<?php

use App\Http\Controllers\Public\ChannelsListController;
use App\Http\Controllers\Public\GetChannelController;
use Illuminate\Support\Facades\Route;

Route::group([], function() {
    Route::get("/i/show/{client_uuid}", ChannelsListController::class);
    Route::get("/i/get/{client_uuid}/{channel_uuid}", GetChannelController::class);
});

