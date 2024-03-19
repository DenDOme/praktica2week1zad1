<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
   public function handle(Request $request)
   {
       if (!Auth::checkEmp() || !Auth::check()) {
           app()->route->redirect('/hello');
       }
   }
}
