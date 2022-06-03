<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group(['middleware' => ['auth']], function() {
//     Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
//     Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
//     Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
// });

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

//
Route::Group(['middleware' => 'auth:sanctum'], function()
{
  Route::get('/auth/getUsers', [UserController::class, 'getUsers']);
  Route::delete('/user/delete/{id}', [UserController::class, 'deleteUser']);
  Route::post('/auth/logout', [AuthController::class, 'logout']);

  Route::group(['prefix'=>'task'], function(){
    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/get/all', [TaskController::class, 'allTasks']);
    Route::get('/get/{id}', [TaskController::class, 'getTask']);
    Route::delete('/delete/{id}', [TaskController::class, 'deleteTask']);
    Route::put('/update/{id}', [TaskController::class, 'updateTask']);
  });
});
