<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{
   use HasFactory;

   public $timestamps = false;
   protected $fillable = [
       'FirstName',
       'LastName',
       'MiddleName',
       'Gender',
       'DateOfBirth',
       'Address',
       'CompoundID',
       'PositionID',
       'DepartmentID',
       'UserRoleID',
       'Image'
   ];

   protected $primaryKey = 'EmployeeID';

   protected static function booted()
   {
       static::created(function ($Employee) {
           $Employee->save();
       });
   }

   public function findIdentity(int $id)
   {
       return self::where('EmployeeID', $id)->first();
   }

   public function getId(): int
   {
       return $this->EmployeeID;
   }

}
