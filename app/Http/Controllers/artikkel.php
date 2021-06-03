<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikkel extends Controller
{
    public function artikkel_create(Request $request) {

        $validated = $request->validate([
            'tittel' => 'required',
            'innhold' => 'required',
            'kategori' => 'required',
        ]);

        \DB::table('artikler')->insert(
            ['tittel' => $request->tittel, 'innhold' => $request->innhold, 'video' => $request->video, 'kategori' => $request->KategoriDataList]
        );
        return redirect()->back();
    }
}
    