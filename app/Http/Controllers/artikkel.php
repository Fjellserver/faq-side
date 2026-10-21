<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class artikkel extends Controller
{
    public function artikkel_create(Request $request)
    {
        $request->flash();

        $validated = $request->validate([
            'tittel' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string', 'max:2000'],
            'innhold' => ['required', 'string'],
            'KategoriDataList' => ['required', 'string', 'max:255', 'exists:kategori,navn'],
            'short' => ['required', 'string', 'max:255'],
            'hide' => ['nullable', 'boolean'],
            'sticky' => ['nullable', 'boolean'],
        ]);

        DB::table('artikler')->insert([
            'tittel' => $validated['tittel'],
            'url' => $this->artikkelUrl($validated['tittel']),
            'intro' => $validated['intro'],
            'innhold' => $validated['innhold'],
            'kategori' => $validated['KategoriDataList'],
            'short' => $validated['short'],
            'hide' => (int) ($validated['hide'] ?? 0),
            'sticky' => (int) ($validated['sticky'] ?? 0),
        ]);

        return redirect()->route('admin-faq');
    }

    public function show_artikler(Request $request)
    {
        $url = $this->queryString($request, 'artikkel', 'stander');

        $artikkel = DB::table('artikler')->where('url', $url)->where('hide', 0)->get();
        $kategori = DB::table('kategori')->orderBy('sticky', 'desc')->where('hide', 0)->orderBy('prioritering', 'desc')->get();

        return view('artikkel', ['artikkel' => $artikkel, 'kategori' => $kategori]);
    }
}
