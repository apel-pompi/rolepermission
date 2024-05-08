<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    PermissionController,RoleController,UserController
};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('permission',PermissionController::class);
Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
