<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Admin',
            'email' => 'quanlybanthan@gmail.com',
            'password' => bcrypt('Hoangquan94!@#')
        ];
        User::insert($user);
    }
}
