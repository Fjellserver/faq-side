<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainshow extends Controller
{
    public function show() {
        $kategori = \DB::table('kategori')->get();
        $artikler = \DB::table('artikler')->get();
            return view('faq', ['kategori' => $kategori, 'artikler' => $artikler]);
        }
}
