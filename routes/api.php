<?php

use App\Http\Resources\PostResource;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\activitiescontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

//posts

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('/users', UsersController::class); //ini bisa buat nambah foto user , bisa juga hapus user
    Route::post('/logoutUser', [AuthController::class, 'logoutUser'])->middleware('auth:api');  //ini untuk logout

    // Semua route di dalam group ini akan dilindungi oleh JWT
});

Route::apiResource('/roles', RolesController::class); 
Route::post('/createUser', [UsersController::class, 'createUser']);   // ini untuk menambahkan user
Route::apiResource('tasks', TaskController::class);

Route::apiResource('activities', activitiescontroller::class);  // ini untuk menambahkan aktivitas
Route::patch('/activities/{id}/status', [ActivitiesController::class, 'updateStatus']);

Route::post('/loginUser', [AuthController::class, 'loginUser']);  //ini untuk login






