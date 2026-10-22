<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery as Middleware;

class PreventRequestForgery extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * Every state-changing route, including the editor image upload, sends the
     * CSRF token, so nothing is excluded.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
