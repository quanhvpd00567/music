<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    protected $table = 'master_categories';

    public $timestamps = true;

    public function masterSite()
    {
        return $this->belongsTo('App\Models\MasterSite', 'master_site_id', 'id' );
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id' );
    }

    public function music()
    {
        return $this->hasMany('App\Models\Music', 'master_category_id', 'id' );
    }
}
