<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Build the public URL slug for an article title.
     *
     * Kept identical to the historic behaviour so existing links keep working.
     */
    protected function artikkelUrl(string $tittel): string
    {
        return str_replace(['?', ' '], ['', '_'], $tittel);
    }

    /**
     * Read a query-string parameter as a plain string, ignoring arrays or other types.
     */
    protected function queryString(Request $request, string $key, string $default = ''): string
    {
        $value = $request->query($key, $default);

        return is_string($value) ? $value : $default;
    }

    /**
     * Read a query-string parameter as a positive integer id, or null when it is not one.
     */
    protected function queryId(Request $request, string $key): ?int
    {
        $value = $request->query($key);

        if (is_string($value) && ctype_digit($value) && (int) $value > 0) {
            return (int) $value;
        }

        return null;
    }
}
