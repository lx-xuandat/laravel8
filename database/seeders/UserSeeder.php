<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=UserSeeder
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $admin = User::where('is_admin', 1)->delete();

        $users = [
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "email_verified_at" => null,
                "current_team_id" => 1,
                "profile_photo_path" => null,
                "is_admin" => 1,
                "password" => bcrypt('12345678'),
            ],
            [
                "name" => "Luu Xuan Dat",
                "email" => "lx.xuandat@gmail.com",
                "email_verified_at" => null,
                "current_team_id" => 1,
                "profile_photo_path" => null,
                "is_admin" => 0,
                "password" => bcrypt('lx.xuandat@gmail.com'),
            ],
            [
                "name" => "David",
                "email" => "david@gmail.com",
                "email_verified_at" => null,
                "current_team_id" => 1,
                "profile_photo_path" => null,
                "is_admin" => 1,
                "password" => bcrypt('david@gmail.com'),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }

        User::factory()->count(10)->create();
    }
}
