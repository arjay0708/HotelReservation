<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReasonDeclineController;
use App\Http\Controllers\ReasonBackOutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserVerifyController;

//UserController
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

//RoomController
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::put('/rooms/{room}', [RoomController::class, 'update']);
Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

//PaymentController
Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/payments/{payment}', [PaymentController::class, 'show']);
Route::put('/payments/{payment}', [PaymentController::class, 'update']);
Route::delete('/payments/{payment}', [PaymentController::class, 'destroy']);

//ReasonDeclineController
Route::post('/reasons-decline', [ReasonDeclineController::class, 'store']);
Route::get('/reasons-decline/{reason}', [ReasonDeclineController::class, 'show']);
Route::put('/reasons-decline/{reason}', [ReasonDeclineController::class, 'update']);
Route::delete('/reasons-decline/{reason}', [ReasonDeclineController::class, 'destroy']);

//ReasonBackOutController
Route::post('/reasons-back-out', [ReasonBackOutController::class, 'store']);
Route::get('/reasons-back-out/{reason}', [ReasonBackOutController::class, 'show']);
Route::put('/reasons-back-out/{reason}', [ReasonBackOutController::class, 'update']);
Route::delete('/reasons-back-out/{reason}', [ReasonBackOutController::class, 'destroy']);

//ReaservationController
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);
Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);

//UserVerifyController
Route::post('/user-verifications', [UserVerifyController::class, 'store']);
Route::get('/user-verifications/{userVerify}', [UserVerifyController::class, 'show']);
Route::put('/user-verifications/{userVerify}', [UserVerifyController::class, 'update']);
Route::delete('/user-verifications/{userVerify}', [UserVerifyController::class, 'destroy']);
