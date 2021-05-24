<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{   
        public function kategori_show() {
            $kategori = \DB::table('kategori')->get();
                return view('dashboard', ['kategori' => $kategori]);
            }
}