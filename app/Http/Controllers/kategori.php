<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kategori extends Controller
{
    public function kategori_create(Request $request)
    {
        $request->flash();

        $validated = $request->validate([
            'navn' => ['required', 'string', 'max:255'],
            'undertekst' => ['required', 'string', 'max:255'],
            'prioritering' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'hide' => ['nullable', 'boolean'],
            'sticky' => ['nullable', 'boolean'],
        ]);

        DB::table('kategori')->insert([
            'navn' => $validated['navn'],
            'undertekst' => $validated['undertekst'],
            'prioritering' => (int) ($validated['prioritering'] ?? 0),
            'hide' => (int) ($validated['hide'] ?? 0),
            'sticky' => (int) ($validated['sticky'] ?? 0),
        ]);

        return redirect()->back();
    }

    public function show_kategori_artikler(Request $request)
    {
        $kategori = $this->queryString($request, 'kategori', 'stander');

        $artikler = DB::table('artikler')->where('kategori', $kategori)->orderBy('sticky', 'desc')->where('hide', 0)->get();

        return view('kategori', ['artikler' => $artikler]);
    }

    public function admin_show_kategori_artikler(Request $request)
    {
        $kategori = $this->queryString($request, 'kategori', 'stander');

        $artikler = DB::table('artikler')->where('kategori', $kategori)->orderBy('sticky', 'desc')->get();

        return view('admin-kategori', ['artikler' => $artikler]);
    }

    public function kategori_edit()
    {
        $kategori = DB::table('kategori')->orderBy('sticky', 'desc')->get();

        return view('redigerkategori', ['kategori' => $kategori]);
    }

    public function selectedkategori(Request $request)
    {
        $id = $this->queryId($request, 'kategori') ?? 1;

        $kategori = DB::table('kategori')->where('id', $id)->get();

        return view('selectedkategori', ['kategori' => $kategori]);
    }

    public function kategori_update(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:kategori,id'],
            'navn' => ['required', 'string', 'max:255'],
            'undertekst' => ['required', 'string', 'max:255'],
            'prioritering' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'hide' => ['nullable', 'boolean'],
            'sticky' => ['nullable', 'boolean'],
            'delid' => ['nullable', 'string', 'max:255'],
        ]);

        $existing = DB::table('kategori')->where('id', $validated['id'])->first();

        // Deletion must be confirmed by typing the category's name (or id) into "delid".
        $confirmDelete = isset($validated['delid'])
            && in_array($validated['delid'], [(string) $existing->id, $existing->navn], true);

        if ($confirmDelete) {
            DB::table('kategori')->where('id', $existing->id)->delete();
        } else {
            DB::table('kategori')
                ->where('id', $existing->id)
                ->update([
                    'navn' => $validated['navn'],
                    'undertekst' => $validated['undertekst'],
                    'prioritering' => (int) ($validated['prioritering'] ?? 0),
                    'hide' => (int) ($validated['hide'] ?? 0),
                    'sticky' => (int) ($validated['sticky'] ?? 0),
                    'last_updated' => now(),
                ]);
        }

        return redirect()->route('redigerkategori');
    }
}
