<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Rute Default
Route::get('/', function () {
    return view('welcome');
});

//Rute GET Sederhana
Route::get('/hello', function () {
    return 'Hello, Word';
});

//Rute dengan Parameter
Route::get('/user/{id}', function ($id) {
    return "User ID:" .$id;
});

//Rute dengan Parameter Opsional
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello," .$name;
});

//Rute dengan Nama
Route::get('/profile', function () {
    return 'This Is The Profile Page.';
})->name('profile');

//Menggunakan Rute Benama Untuk Pengalihan
Route::get('/redirec-to-profile', function () {
    return redirect()->route('profile');
});


Route :: prefix('admin')->group(function () {
    Route :: get('/dashboard', function () {
    return 'Admin Dashboard';
    });

    Route :: get('/profile', function () {
        return 'Admin Profile';
    });
});


Route::get('/dashboard', function () {
    return 'Welcome to your dashboard!';
})->middleware('auth');

Route::resource('posts','PostController');
