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

Route::middleware(['web'])->group(function () {

    // guest users
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('loginForm');
        Route::post('/login', 'LoginController@login')->name('login');
    });

    // authenticated users
    Route::middleware(['auth'])->group(function () {
        Route::get('/', function(){
            return redirect('user');
        });
        Route::get('/home', function(){
            return redirect('user');
        });
        Route::post('/logout', 'LoginController@logout')->name('logout');

        // admin role
        Route::prefix('user')->group(function () {
            Route::get('/', 'UserController@index')->name('listUser');
            Route::get('/create', 'UserController@add')->name('addUser');
            Route::post('/create/confirm', 'UserController@confirm')->name('userCreateConfirm');
            Route::post('/create/complete', 'UserController@complete')->name('userCreateComplete');
            Route::any('/edit', 'UserController@edit')->name('editUser');
            Route::post('/edit/confirm', 'UserController@editConfirm')->name('userEditConfirm');
            Route::post('/edit/complete', 'UserController@editComplete')->name('userEditComplete');
            Route::post('/delete', 'UserController@delete')->name('deleteUser');
            Route::post('/export', 'UserController@export')->name('exportUser');
        });

    });
});