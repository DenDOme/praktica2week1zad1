<?php
return [
   'auth' => \Src\Auth\Auth::class,
   'identity'=>\Model\User::class,
   'routeMiddleware' => [
      'auth' => \Middlewares\AuthMiddleware::class,
      'role' => \Middlewares\RoleMiddleware::class,
      'trim' => \Middlewares\TrimMiddleware::class,
      'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
      'csrf' => \Middlewares\CSRFMiddleware::class,
   ],
   'validators' => [
      'required' => \Validators\RequireValidator::class,
      'unique' => \Validators\UniqueValidator::class
  ]
];
