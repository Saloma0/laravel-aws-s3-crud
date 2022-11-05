<?php

use App\Http\Controllers\ProductController;
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

Route::get('/create', function(){
    return view('create');
})->name('create.product');

Route::controller(ProductController::class)->group(function(){
    Route::get('/','index');
    Route::post('/store','store')->name('store.product');
    Route::post('/update/{id}','update')->name('update.product');
    Route::get('/edit/{id}','edit')->name('edit.product');
    Route::get('/delete/{id}','destroy')->name('delete.product');
});
