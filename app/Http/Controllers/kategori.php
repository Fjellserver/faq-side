<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kategori extends Controller
{
    public function kategori_create(Request $request) {

        $validated = $request->validate([
            'navn' => 'required',
            'undertekst' => 'required',
            'prioritering' => 'required',
        ]);

        \DB::table('kategori')->insert(
            [
            'navn' => $request->navn, 
            'undertekst' => $request->undertekst, 
            'prioritering' => $request->prioritering,
            'hide' => is_null($request->hide) ? 0 : $request->hide,
            'sticky' => is_null($request->sticky) ? 0 : $request->sticky,
            ]
        );
        return redirect()->back();
    }

    public function show_kategori_artikler() {
        $kategori = \Input::get('kategori', 'stander');
        $artikler = \DB::table('artikler')->where('kategori', $kategori)->orderBy('sticky', 'desc')->where('hide', 0)->get();
            return view('kategori', ['artikler' => $artikler]);
        }

    public function kategori_edit() {
        $kategori = \DB::table('kategori')->orderBy('sticky', 'desc')->where('hide', 0)->get();
            return view('redigerkategori', ['kategori' => $kategori]);
    }    

    public function selectedkategori() {
        $kategori_input = \Input::get('kategori', '1');
        $kategori = \DB::table('kategori')->where('id', $kategori_input)->get();
            return view('selectedkategori', ['kategori' => $kategori]);
    }

    public function kategori_update(Request $request) {
        $validated = $request->validate([
            'navn' => 'required',
            'undertekst' => 'required',
            'prioritering' => 'required',
        ]);
        
        if($request->delid == $request->navn) {
            \DB::table('kategori')
            ->where('id', $request->id)->delete();
        }

        else {
            \DB::table('kategori')
            ->where('id', $request->id)
            ->update([
                'navn' => $request->navn,
                'undertekst' => $request->undertekst,
                'prioritering' => is_null($request->rank) ? 0 : $request->rank,
                'hide' => is_null($request->hide) ? 0 : $request->hide,
                'sticky' => is_null($request->sticky) ? 0 : $request->sticky,
                'last_updated' => now()
        ]);
        }
        return redirect()->route('redigerkategori');
    }
}