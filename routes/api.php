<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::post('/auth/login', [ApiAuthController::class, 'login'])->name('login.api');
Route::post('/auth/register', [ApiAuthController::class, 'register'])->name('register.api');
Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::post('/', function (Request $request) {
        return new UserResource(User::find($request->id));
    });
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
});
