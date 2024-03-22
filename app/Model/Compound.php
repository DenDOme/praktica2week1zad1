<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compound extends Model 
{
   use HasFactory;

   public $timestamps = false;
   protected $fillable = [
       'CompoundName',
   ];

   protected $primaryKey = 'CompoundID';

   protected static function booted()
   {
       static::created(function ($compound) {
           $compound->save();
       });
   }

   public function findIdentity(int $id)
   {
       return self::where('Compound', $id)->first();
   }

   public function getId(): int
   {
       return $this->CompoundID;
   }

}
