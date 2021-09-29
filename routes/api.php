<?php

use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('categories',[CatController::class, 'index']);
Route::get('categories/show/{id}',[CatController::class, 'show']);
Route::get('skill/show/{id}',[SkillController::class, 'show']);
Route::get('exam/show/{id}',[ExamController::class, 'show']);
Route::get('exam/show-question/{id}',[ExamController::class, 'show_question']);
Route::post('exam/submit/{id}',[ExamController::class, 'submit']);
Route::post('exam/start/{id}',[ExamController::class, 'start']);






