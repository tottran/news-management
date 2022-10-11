<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // TODO: [TKT-4] cần tìm hiểu về việc gắn @csrf. tạm thời đang đóng csrf để triển khai vấn đề khác.
        'form',
    ];
}
