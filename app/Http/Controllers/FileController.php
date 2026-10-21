<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Handle image uploads from the TinyMCE editor.
     *
     * Only real image files are accepted, and the stored file gets a random
     * name so the client can never choose the path or extension on disk.
     */
    public function upload(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
        ]);

        $path = $validated['file']->store('uploads', 'public');

        return response()->json(['location' => '/storage/'.$path]);
    }
}
