<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kategori extends Controller
{
    public function kategori_create(Request $request) {
        \DB::table('kategori')->insert(
            ['navn' => $request->navn, 'undertekst' => $request->undertekst]
        );
        return redirect()->back();
    }
}
