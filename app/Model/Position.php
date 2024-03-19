<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model 
{
   use HasFactory;

   public $timestamps = false;
   protected $fillable = [
       'PositionName',
   ];

   protected $primaryKey = 'PositionID';

   protected static function booted()
   {
       static::created(function ($position) {
           $position->save();
       });
   }

   public function findIdentity(int $id)
   {
       return self::where('PositionID', $id)->first();
   }

   public function getId(): int
   {
       return $this->PositionID;
   }

}
