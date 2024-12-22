<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Route::group(['middleware' => ['auth']], function () {
    Route::get('/pages', [PageController::class, 'apiPages']);
// });
