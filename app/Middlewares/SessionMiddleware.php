<?php

namespace Middlewares;

use Src\Request;
use session\Session;

class SessionMiddleware
{
    public function handle(Request $request, $args = null): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}