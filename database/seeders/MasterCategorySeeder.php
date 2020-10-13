<?php

namespace Database\Seeders;

use App\Models\MasterCategory;
use Illuminate\Database\Seeder;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['category_clone'=>'nnhac-Electro-House-c9.html', 'slug' => 'nhac-Electro-House-c9.html', 'category_id' => 1, 'master_site_id' => 1],
            ['category_clone'=>'nhac-Nonstop-c5.html', 'slug' => 'nhac-Nonstop-c5.html', 'category_id' => 2, 'master_site_id' => 1],
            ['category_clone'=>'nhac-Viet-Remix-c7.html', 'slug' => 'nhac-Viet-Remix-c7.html', 'category_id' => 1, 'master_site_id' => 1],
        ];

        MasterCategory::insert($data);
    }
}
