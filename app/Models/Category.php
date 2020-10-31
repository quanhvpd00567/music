<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'uuid', 'status'
    ];

    public $timestamps = true;

    public function masterCategories() {
        return $this->hasMany('App\Models\MasterCategory', 'category_id', 'id');
    }

    public function songs() {
        return $this->hasMany(Song::class);
    }
}
