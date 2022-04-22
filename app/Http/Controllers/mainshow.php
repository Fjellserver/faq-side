<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainshow extends Controller
{
    public function show() {
        $kategori = \DB::table('kategori')->orderBy('sticky', 'desc')->where('hide', 0)->orderBy('prioritering', 'desc')->get();
            return view('faq', ['kategori' => $kategori]);
        }
}
