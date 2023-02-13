<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\Questionnaire;
use App\Http\Controllers\Web\QsnBank;
use App\Http\Controllers\Web\RegisterController;
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

/**
 * Entry point for admin
 */
Route::prefix('/admin')->name('admin')->group(function () {
    Route::get('/', function () {
        return view('admin');
    });
    Route::get('{any}', function () {
        return view('admin');
    })->where('any', '.*');
});

/**
 * Entry point for student
 */
Route::get('/student/test/{code}', function () {
    return view('student');
})->name('student.test');

Route::group(["middleware" => "guest"], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::group(["middleware" => "auth"], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //routes for question banks
    Route::get('/qbank', [QsnBank::class, 'index'])->name('qbank.list');
    Route::delete('/qbank/{id}', [QsnBank::class, 'delete'])->name('qbank.delete');
    //rout for question sets
    Route::get('/questions', [Questionnaire::class, 'index'])->name('questions.list');
    Route::get('/questions/create', [Questionnaire::class, 'create'])->name('questions.create');
    Route::post('/questions', [Questionnaire::class, 'store'])->name('questions.store');
    Route::get('/questions/email/{questionList}', [Questionnaire::class, 'email'])->name('questions.email');
});
Route::view('/home', "home.index")->name('home');
