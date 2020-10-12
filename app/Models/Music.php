<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'music';
    public $timestamps = true;

    public $fillable = [
        'id',
        'name',
        'link_clone',
        'master_category_id',
        'user_id',
        'link',
        'image',
        'status',
        'view',
        'download',
        'liked',
        'dislike',
        'link_mp3',
        'link_updated_at',
        'created_at'
    ];

    public static $website = [
        'nhac_dj_vn' => 'https://nhacdj.vn',
        'remixviet_net' => 'https://www.remixviet.net'
    ];

    public function masterCategory()
    {
        return $this->belongsTo('App\Models\MasterCategory', 'master_category_id', 'id');
    }

}
