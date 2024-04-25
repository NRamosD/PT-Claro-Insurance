<?php

use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/student', [studentController::class, "getAllStudents"]);
Route::get('/student/{id}', [studentController::class, "getStudentById"]);
Route::post('/student', [studentController::class, "createStudent"]);
Route::put('/student/{id}', [studentController::class, "updateStudent"]);
Route::delete('/student/{id}', [studentController::class, "deleteStudent"]);



