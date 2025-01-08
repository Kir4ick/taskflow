<?php

use App\Dictionaries\Permissions;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::post('users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('check-permission:' . Permissions::CREATE_USER );



});
