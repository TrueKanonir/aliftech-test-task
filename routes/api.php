<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ApiUserController;
use App\Http\Controllers\Api\V1\ApiSearchController;
use App\Http\Controllers\Api\V1\ApiContactController;

# V1 api routes
Route::prefix('v1')->group(function () {
    # Users
    Route::resource('users',ApiUserController::class);

    # Contacts
    Route::resource('users.contacts',ApiContactController::class)
        ->shallow();

    # Search
    Route::get('search', ApiSearchController::class);
});
