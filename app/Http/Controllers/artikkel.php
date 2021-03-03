<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikkel extends Controller
{
    public function artikkel_create(Request $request) {
        \DB::table('hosts')->insert(
            ['tittel' => $request->tittel, 'innhold' => $request->innhold, 'video' => $request->video, 'kategori' => $request->kategori]
        );

        return redirect()->back();
    }
}
