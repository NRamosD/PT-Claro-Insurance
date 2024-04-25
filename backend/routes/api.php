<?php

use App\Http\Controllers\administratorController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\daysController;
use App\Http\Controllers\scheduleController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\studentCoursesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//API ROUTES

Route::get('/administrator', [administratorController::class, "getAllAdministrators"]);
Route::get('/administrator/{id}', [administratorController::class, "getAdministratorById"]);
Route::post('/administrator', [administratorController::class, "createAdministrator"]);
Route::put('/administrator/{id}', [administratorController::class, "updateAdministrator"]);
Route::delete('/administrator/{id}', [administratorController::class, "deleteAdministrator"]);

Route::get('/student', [studentController::class, "getAllStudents"]);
Route::get('/student/{id}', [studentController::class, "getStudentById"]);
Route::post('/student', [studentController::class, "createStudent"]);
Route::put('/student/{id}', [studentController::class, "updateStudent"]);
Route::delete('/student/{id}', [studentController::class, "deleteStudent"]);

Route::get('/course', [coursesController::class, "getAllCourses"]);
Route::get('/course/{id}', [coursesController::class, "getCourseById"]);
Route::post('/course', [coursesController::class, "createCourse"]);
Route::put('/course/{id}', [coursesController::class, "updateCourse"]);
Route::delete('/course/{id}', [coursesController::class, "deleteCourse"]);

Route::get('/days', [daysController::class, "getAllDays"]);
Route::get('/days/{id}', [daysController::class, "getDayById"]);
Route::post('/days', [daysController::class, "createDay"]);
Route::put('/days/{id}', [daysController::class, "updateDay"]);
Route::delete('/days/{id}', [daysController::class, "deleteDay"]);

Route::get('/schedule', [scheduleController::class, "getAllSchedules"]);
Route::get('/schedule/{id}', [scheduleController::class, "getScheduleById"]);
Route::post('/schedule', [scheduleController::class, "createSchedule"]);
Route::put('/schedule/{id}', [scheduleController::class, "updateSchedule"]);
Route::delete('/schedule/{id}', [scheduleController::class, "deleteSchedule"]);

Route::get('/student_courses', [studentCoursesController::class, "getAllStudentCourses"]);
Route::get('/student_courses/{id}', [studentCoursesController::class, "getStudentCourseById"]);
Route::post('/student_courses', [studentCoursesController::class, "createStudentCourse"]);
Route::put('/student_courses/{id}', [studentCoursesController::class, "updateStudentCourse"]);
Route::delete('/student_courses/{id}', [studentCoursesController::class, "deleteStudentCourse"]);

