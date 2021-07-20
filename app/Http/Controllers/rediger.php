<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class rediger extends Controller
{
    public function artikkel_show() {
        $artikler = \DB::table('artikler')->get();
            return view('rediger', ['artikler' => $artikler]);
        }

    public function artikkel_edit() {
        $innhold = \DB::table('artikler')->get();
        $kategori = \DB::table('kategori')->get();
        $artikkler_input = \Input::get('artikkel', 'stander');
        $artikkel = \DB::table('artikler')->where('tittel', $artikkler_input)->get();
            return view('side', ['artikkel' => $artikkel, 'innhold' => $innhold, 'kategori' => $kategori]);
    }
    public function artikkel_update(Request $request) {
        $validated = $request->validate([
            'tittel' => 'required',
            'innhold' => 'required',
            'KategoriDataList' => 'required',
        ]);

        \DB::table('artikler')
            ->where('id', $request->id)
            ->update([
                'tittel' => $request->tittel, 
                'innhold' => $request->innhold, 
                'kategori' => $request->KategoriDataList,
                'created_at' => now()
        ]);
        return redirect()->route('rediger');
    }
}
