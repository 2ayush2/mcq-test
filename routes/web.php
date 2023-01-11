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

Route::get('/admin', function () {
    return view('admin');
});
Route::get('/test', function () {
    return view('studentTest');
});
Route::post('/test/{testid}', [StudentTest::class, 'store']);
