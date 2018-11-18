<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('examen', function () {
    return view('multiplechoice');
});

Route::get('tema1', function () {
    return view('tema1');
});

/* Route::namespace('Generator')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    return view('tema1');
}); */