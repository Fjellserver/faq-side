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
        $artikkel = \DB::table('artikler')->where('id', $artikkler_input)->get();
            return view('side', ['artikkel' => $artikkel, 'innhold' => $innhold, 'kategori' => $kategori]);
    }
    public function artikkel_update(Request $request) {
        $validated = $request->validate([
            'tittel' => 'required',
            'intro' => 'required',
            'innhold' => 'required',
            'KategoriDataList' => 'required',
            'short' => 'required',
        ]);

        $urltrim = str_replace(" ", "_", $request->tittel);
        $urltrimfinaly = str_replace("?", "", $urltrim);  
        
        if($request->delid == $request->tittel) {
            \DB::table('artikler')
            ->where('tittel', $request->tittel)->delete();
        }

        else {
            \DB::table('artikler')
            ->where('id', $request->id)
            ->update([
                'tittel' => $request->tittel,
                'url' => $urltrimfinaly,
                'intro' => $request->intro,
                'innhold' => $request->innhold,
                'kategori' => $request->KategoriDataList,
                'short' => $request->short,
                'hide' => is_null($request->hide) ? 0 : $request->hide,
                'sticky' => is_null($request->sticky) ? 0 : $request->sticky,
                'last_updated' => now()
        ]);
        }
        return redirect()->route('rediger');
    }
}
