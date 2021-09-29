<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\langController;
use App\Http\Controllers\web\profileController;
use App\Http\Controllers\web\SkilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('lang')->group(function(){
    Route::get('/',[HomeController::class,'index']);
    Route::get('/categories/show/{id}',[CatController::class,'show']);
    Route::get('/skill/show/{id}',[SkilController::class,'show']);
    Route::get('/exam/show/{id}',[ExamController::class,'show']);
    Route::get('/exam/questions/{id}',[ExamController::class,'questions'])->middleware(["auth","verified","IsStudent"]);
    Route::get('/contact',[ContactController::class,'contact']);
    Route::get('/profile',[profileController::class,'index'])->middleware(["auth","verified","IsStudent"]);

});
Route::post('/exam/start/{id}',[ExamController::class,'start'])->middleware(["auth","verified","IsStudent","canEnter"]);
Route::post('/exam/submit/{id}',[ExamController::class,'submit'])->middleware(["auth","verified","IsStudent"]);


Route::post('/contact/massage/send',[ContactController::class,'send']);
Route::get('/lang/set/{lang}',[langController::class,'set'])->middleware('lang');

Route::prefix('dashboard')->middleware(["auth","verified","EnterDashbord"])->group(function() {
    Route::get('/',[AdminHomeController::class,'index']);
    Route::get('/catagories',[AdminCatController::class,'index']);
    Route::post('/catagories/store',[AdminCatController::class,'store']);
    Route::post('/catagories/updata',[AdminCatController::class,'updata']);
    Route::get('/catagories/delete/{id}',[AdminCatController::class,'delete']);
    Route::get('/catagories/toggal/{id}',[AdminCatController::class,'toggal']);

    Route::get('/skills',[SkillController::class,'index']);
    Route::post('/skills/store',[SkillController::class,'store']);
    Route::post('/skills/updata',[SkillController::class,'updata']);
    Route::get('/skills/delete/{id}',[SkillController::class,'delete']);
    Route::get('/skills/toggal/{id}',[SkillController::class,'toggal']);

    Route::get('/exams',[AdminExamController::class,'index']);
    Route::get('/exams/show/{exam}',[AdminExamController::class,'show']);
    Route::get('/exams/show/{exam}/questions',[AdminExamController::class,'showQuestions']);
    Route::get('/exams/create',[AdminExamController::class,'create']);
    Route::get('/exams/create-questions/{exam}',[AdminExamController::class,'createQuestions']);
    Route::post('/exams/store-questions/{exam}',[AdminExamController::class,'storeQuestions']);
    Route::get('/exams/edit-questions/{exam}/{questions}',[AdminExamController::class,'editQuestions']);
    Route::post('/exams/update-questions/{exam}/{questions}',[AdminExamController::class,'updateQuestions']);
    Route::post('/exams/store',[AdminExamController::class,'store']);
    Route::get('/exams/edit/{exam}',[AdminExamController::class,'edit']);
    Route::post('/exams/updata/{exam}',[AdminExamController::class,'updata']);
    Route::get('/exams/delete/{id}',[AdminExamController::class,'delete']);
    Route::get('/exams/toggal/{id}',[AdminExamController::class,'toggal']);

    Route::get('/student',[StudentController::class, 'index']);
    Route::get('/student/show-scores/{id}',[StudentController::class, 'showscores']);
    Route::get('/student/open-exam/{studentId}/{examId}',[StudentController::class, 'openExam']);
    Route::get('/student/close-exam/{studentId}/{examId}',[StudentController::class, 'closeExam']);

    Route::get('/admins',[AdminController::class, 'index']);
    Route::get('/admins/create',[AdminController::class, 'create']);
    Route::post('/admins/store',[AdminController::class, 'store']);
    Route::get('/admins/promote/{id}',[AdminController::class, 'promote']);
    Route::get('/admins/demote/{id}',[AdminController::class, 'demote']);

    



});