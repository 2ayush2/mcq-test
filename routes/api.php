<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QsnBank;
use App\Http\Controllers\Api\Questionnaire;
use App\Http\Controllers\Api\StudentTest;
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

/**
 * Authentication Module
 */
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    /**
     * Questionnaire Module
     */
    Route::get('questions', [Questionnaire::class, 'index'])->name('admin.test.list');
    Route::post('questions', [Questionnaire::class, 'store'])->name('admin.test.add');
    Route::get('questions/email/{questionList}', [Questionnaire::class, 'email'])->name('admin.test.email');

    /**
     * Question Bank Module
     */
    Route::get('qbank', [QsnBank::class, 'index'])->name('admin.qbank.list');
    Route::post('qbank', [QsnBank::class, 'delete'])->name('admin.qbank.add');
});

/**
 * Student answer submiting point
 */
Route::get('/student/test/{studentAnswer:code}', [StudentTest::class, 'questions'])->name('test.get');
Route::post('/student/test/{studentAnswer:code}', [StudentTest::class, 'store'])->name('test.save');
