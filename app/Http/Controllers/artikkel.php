<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikkel extends Controller
{
    public function artikkel_create(Request $request) {
        \DB::table('hosts')->insert(
            ['name' => $request->host, 'ip' => $request->ip, 'rank' => $request->rank]
        );

        return redirect()->back();
    }
}
