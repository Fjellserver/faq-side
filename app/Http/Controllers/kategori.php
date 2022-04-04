<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kategori extends Controller
{
    public function kategori_create(Request $request) {

        $validated = $request->validate([
            'navn' => 'required',
            'undertekst' => 'required',
        ]);

        \DB::table('kategori')->insert(
            ['navn' => $request->navn, 'undertekst' => $request->undertekst]
        );
        return redirect()->back();
    }

    public function show_kategori_artikler() {
        $kategori = \Input::get('kategori', 'stander');
        //$artikler = \DB::table('artikler')->where('kategori', $kategori)->get();
        $artikler = \DB::table('artikler')->where('kategori', $kategori)->orderBy('sticky', 'desc')->where('hide', 0)->get();
            return view('kategori', ['artikler' => $artikler]);
        }
}
