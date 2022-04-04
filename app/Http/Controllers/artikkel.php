<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikkel extends Controller
{
    public function artikkel_create(Request $request) {
        $validated = $request->validate([
            'tittel' => 'required',
            'intro' => 'required',
            'innhold' => 'required',
            'KategoriDataList' => 'required',
            'short' => 'required',
        ]);

        $urltrim = str_replace(" ", "_", $request->tittel);
        $urltrimfinaly = str_replace("?", "", $urltrim);
        \DB::table('artikler')->insert(
            ['tittel' => $request->tittel, 'url' => $urltrimfinaly, 'intro' => $request->intro, 'innhold' => $request->innhold, 'kategori' => $request->KategoriDataList, 'short' => $request->short, 'hide' => $request->hide, 'sticky' => $request->sticky]
        );
        return redirect()->back();
    }

    public function show_artikler() {
        $artikler = \Input::get('artikkel', 'stander');
        $artikkel = \DB::table('artikler')->where('tittel', $artikler)->get();
            return view('artikkel', ['artikkel' => $artikkel]);
    }
}
    