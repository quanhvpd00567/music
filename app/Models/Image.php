<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $table = 'images';

   public $timestamps = true;
   public static $typesValue = [
        'thumb' => 0,
        'bg_detail' => 1
   ];
    public static $listImageType = [
        0 => 'Thumb image',
        1 => 'Background song detail',
    ];
   protected $fillable = [
       'url', 'img_type', 'status'
   ];
}
