<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikkel extends Controller
{
    public function artikkel_create(Request $request) {
        $request->flash();
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
            [
            'tittel' => $request->tittel,
            'url' => $urltrimfinaly,
            'intro' => $request->intro,
            'innhold' => $request->innhold,
            'kategori' => $request->KategoriDataList,
            'short' => $request->short,
            'hide' => is_null($request->hide) ? 0 : $request->hide,
            'sticky' => is_null($request->sticky) ? 0 : $request->sticky,
            ]
        );
        return redirect()->route('faq');
    }

    public function show_artikler() {
        $artikler = \Input::get('artikkel', 'stander');
        $urlkategori = \Input::get('kategori', 'stander');
        $artikkel = \DB::table('artikler')->where('url', $artikler)->get();
        $kategori = \DB::table('kategori')->orderBy('sticky', 'desc')->where('hide', 0)->orderBy('prioritering', 'desc')->get();
            return view('artikkel', ['artikkel' => $artikkel, 'kategori' => $kategori, 'urlkategori' => $urlkategori]);
    }
}
    