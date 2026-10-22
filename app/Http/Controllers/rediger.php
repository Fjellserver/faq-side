<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rediger extends Controller
{
    public function artikkel_edit(Request $request)
    {
        $id = $this->queryId($request, 'artikkel');

        $kategori = DB::table('kategori')->get();
        $artikkel = DB::table('artikler')->where('id', $id)->get();

        return view('side', ['artikkel' => $artikkel, 'kategori' => $kategori]);
    }

    public function artikkel_update(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:artikler,id'],
            'tittel' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string', 'max:2000'],
            'innhold' => ['required', 'string'],
            'KategoriDataList' => ['required', 'string', 'max:255', 'exists:kategori,navn'],
            'short' => ['required', 'string', 'max:255'],
            'hide' => ['nullable', 'boolean'],
            'sticky' => ['nullable', 'boolean'],
            'delid' => ['nullable', 'string', 'max:255'],
        ]);

        $existing = DB::table('artikler')->where('id', $validated['id'])->first();

        // Deletion must be confirmed by typing the article's title (or id) into "delid",
        // and only ever removes this one row.
        $confirmDelete = isset($validated['delid'])
            && in_array($validated['delid'], [(string) $existing->id, $existing->tittel], true);

        if ($confirmDelete) {
            DB::table('artikler')->where('id', $existing->id)->delete();
        } else {
            DB::table('artikler')
                ->where('id', $existing->id)
                ->update([
                    'tittel' => $validated['tittel'],
                    'url' => $this->artikkelUrl($validated['tittel']),
                    'intro' => $validated['intro'],
                    'innhold' => $validated['innhold'],
                    'kategori' => $validated['KategoriDataList'],
                    'short' => $validated['short'],
                    'hide' => (int) ($validated['hide'] ?? 0),
                    'sticky' => (int) ($validated['sticky'] ?? 0),
                    'last_updated' => now(),
                ]);
        }

        return redirect()->route('admin-faq');
    }
}
