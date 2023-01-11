<?php

use App\Http\Controllers\Api\AuthController;
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
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    /**
     * Questionnaire Module
     */
    Route::get('questions', [Questionnaire::class, 'index']);
    Route::post('questions', [Questionnaire::class, 'store']);
});

/**
 * Entry point for admin
 */
Route::get('admin', function () {
    return view("");
});

/**
 * Entry point for student
 */
Route::get('test/{testid}', function () {
    return view("");
});

Route::get('test/{testid}', [StudentTest::class, 'store']);
