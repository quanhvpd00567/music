<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSite extends Model
{
    protected $table = 'master_sites';

    public $timestamps = true;

    public static $status = [
        'clone' => 0,
        'not_clone' => 1
    ];

    public static $batch = [
        'run' => 0,
        'not_run' => 1
    ];

    public $fillable = [
        'id', 'website', 'status', 'is_run_batch'
    ];

    public function masterCategories() {
        return $this->hasMany('App\Models\MasterCategory', 'master_site_id', 'id');
    }
}
