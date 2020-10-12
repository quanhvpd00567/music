<?php

namespace Database\Seeders;

use App\Models\MasterSite;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['website'=>'https://nhacdj.vn', 'name'=> 'Nhac DJ VN'],
            ['website'=>'https://www.remixviet.net', 'name'=> 'Remix Viet'],
        ];

        MasterSite::insert($data);
    }
}
