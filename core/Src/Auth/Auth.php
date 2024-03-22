<?php

namespace Src\Auth;

use session\Session;

class Auth
{
   private static IdentityInterface $user;

   public static function init(IdentityInterface $user): void
   {
       self::$user = $user;
       if (self::user()) {
           self::login(self::user());
       }
   }

   public static function login(IdentityInterface $user): void
   {
       self::$user = $user;
       Session::set('UserRoleID', self::$user->getId());
       Session::set('role', self::$user->role);
   }

   public static function attempt(array $credentials): bool
   {
       if ($user = self::$user->attemptIdentity($credentials)) {
           self::login($user);
           return true;
       }
       return false;
   }

   public static function user()
   {
       $id = Session::get('UserRoleID') ?? 0;
       return self::$user->findIdentity($id);
   }

   public static function check(): bool
   {
       if (self::user()) {
           return true;
       }
       return false;
   }

   public static function checkEmp()
   {
        $role = Session::get('role') ?? 0;
        if($role === 'admin' || $role === 'employee'){
            return true;
        }
        return false;
   }

   public static function logout(): bool
   {
       Session::clear('UserRoleID');
       return true;
   }

   public static function generateCSRF(): string
    {
        $token = md5(time());
        Session::set('csrf_token', $token);
        return $token;
    }

}
