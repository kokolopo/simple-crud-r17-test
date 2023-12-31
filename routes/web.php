<?php

use App\Http\Controllers\UserController;
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

Route::post('/users', [UserController::class, 'fetchUsers'])->name('hit_api');
Route::get('/', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'tamabah'])->name('save_user');
Route::put('/users/{id}', [UserController::class, 'update'])->name('update_user');
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('delete_user');

