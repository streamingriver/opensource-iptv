<?php

use App\Http\Controllers\Api\TokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/tokens", TokensController::class);

