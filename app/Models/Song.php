<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
//    use HasFactory;
    protected $table = 'songs';

    public static $status = [
      'approved' => 0,
      'pending' => 1,
      'reject' => 2,
    ];
    public static $setLink = [
        'yes' => 1,
        'no' => 0
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
