<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Remix viet moi', 'slug'=> 'remix-viet-moi'],
            ['name'=>'Remix Hot', 'slug'=> 'remix-hot'],
        ];

        Category::insert($data);
    }
}
