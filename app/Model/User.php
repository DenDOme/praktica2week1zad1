<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
   use HasFactory;

   public $timestamps = false;
   protected $fillable = [
       'name',
       'login',
       'password',
       'role'
   ];

   protected $primaryKey = 'UserRoleID';

   protected static function booted()
   {
       static::created(function ($user) {
           $user->password = md5($user->password);
           $user->role = 'quest';
           $user->save();
       });
   }

   public function findIdentity(int $id)
   {
       return self::where('UserRoleID', $id)->first();
   }

   public function getId(): int
   {
       return $this->UserRoleID;
   }

   public function attemptIdentity(array $credentials)
   {
       return self::where(['login' => $credentials['login'],
           'password' => md5($credentials['password'])])->first();
   }

}
