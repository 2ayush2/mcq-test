<?php

use App\Http\Controllers\Api\StudentTest;
use App\Models\StudentAnswer;
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
Route::get('/admin', function () {
    return view('admin');
});

/**
 * Entry point for student
 */
Route::get('/student/test/{testid}', function () {
    return view('student');
})->name('student.test');
