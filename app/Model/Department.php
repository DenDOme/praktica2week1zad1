<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model 
{
   use HasFactory;

   public $timestamps = false;
   protected $fillable = [
       'DepartmentName',
       'DepartmentType',
   ];

   protected $primaryKey = 'DepartmentID';

   protected static function booted()
   {
       static::created(function ($Department) {
           $Department->save();
       });
   }

   public function findIdentity(int $id)
   {
       return self::where('DepartmentID', $id)->first();
   }

   public function getId(): int
   {
       return $this->DepartmentID;
   }

}
