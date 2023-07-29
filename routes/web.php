<?php

use App\Http\Controllers\ProdukController;
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

Route::get('/', [ProdukController::class, 'index']);
Route::post('/produk', [ProdukController::class, 'tamabah'])->name('save_produk');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('update_produk');
Route::delete('/produk/{id}', [ProdukController::class, 'delete'])->name('delete_produk');

