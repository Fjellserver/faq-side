<?php

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

Route::get('/', 'App\Http\Controllers\kategori@kategori_show', function () {
    return view('faq');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\admin@kategori_show', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->post('dashboard/kategori', 'App\Http\Controllers\kategori@kategori_create', function () {
});

Route::middleware(['auth:sanctum', 'verified'])->post('dashboard/artikkel', 'App\Http\Controllers\artikkel@artikkel_create', function () {
});