<?php
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\BookingController;

Route::prefix('api')->group(function () {
    Route::get('classrooms', [ClassroomController::class, 'index']);
    Route::post('bookings', [BookingController::class, 'book']);
    Route::delete('bookings/{id}', [BookingController::class, 'cancel']);
});