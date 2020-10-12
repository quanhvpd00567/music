<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function masterCategories() {
        return $this->hasMany('App\Models\MasterCategory', 'category_id', 'id');
    }
}
