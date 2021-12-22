<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikkel extends Controller
{
    public function artikkel_create(Request $request) {

        $validated = $request->validate([
            'tittel' => 'required',
            'innhold' => 'required',
            'KategoriDataList' => 'required',
            'short' => 'required',
        ]);

        \DB::table('artikler')->insert(
            ['tittel' => $request->tittel, 'innhold' => $request->innhold, 'kategori' => $request->KategoriDataList, 'short' => $request->short]
        );
        return redirect()->back();
    }

    public function show_artikler() {
        $artikler = \Input::get('artikkel', 'stander');
        $artikkel = \DB::table('artikler')->where('tittel', $artikler)->get();
            return view('artikkel', ['artikkel' => $artikkel]);
    }
}
    