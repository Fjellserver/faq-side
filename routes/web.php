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

Route::get('/', 'App\Http\Controllers\mainshow@show', function () {
    return view('faq');
})->name('faq');

Route::get('/kategori', ['as' => 'kategori', 'uses' => 'App\Http\Controllers\kategori@show_kategori_artikler'], function () {
    return view('kategori');
});

Route::get('/artikkel', ['as' => 'artikkel', 'uses' => 'App\Http\Controllers\artikkel@show_artikler'], function () {
    return view('artikkel');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\admin@main_show', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/rediger/side', ['as' => 'artikkel', 'uses' => 'App\Http\Controllers\rediger@artikkel_edit'], function () {
    return view('side');
})->name('side');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/rediger/kategori', 'App\Http\Controllers\kategori@kategori_edit', function () {
    return view('redigerkategori');
})->name('redigerkategori');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/rediger/kategori/selectedkategori', ['as' => 'selectedkategori', 'uses' => 'App\Http\Controllers\kategori@selectedkategori'], function () {
    return view('selectedkategori');
})->name('selectedkategori');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/faq', 'App\Http\Controllers\mainshow@admin_show', function () {
    return view('admin-faq');
})->name('admin-faq');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/kategori', ['as' => 'kategori', 'uses' => 'App\Http\Controllers\kategori@admin_show_kategori_artikler'], function () {
    return view('admin-kategori');
})->name('admin-kategori');

Route::middleware(['auth:sanctum', 'verified'])->post('dashboard/kategori', 'App\Http\Controllers\kategori@kategori_create', function () {
});

Route::middleware(['auth:sanctum', 'verified'])->post('dashboard/artikkel', 'App\Http\Controllers\artikkel@artikkel_create', function () {
});

Route::middleware(['auth:sanctum', 'verified'])->post('/dashboard/rediger/side', 'App\Http\Controllers\rediger@artikkel_update', function () {
});

Route::middleware(['auth:sanctum', 'verified'])->post('/dashboard/rediger/kategori/selectedkategori', 'App\Http\Controllers\kategori@kategori_update', function () {
});

Route::middleware(['auth:sanctum', 'verified'])->post('/upload', 'App\Http\Controllers\FileController@upload', function () {
});
