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
        $admin = User::where('is_admin', 1)->delete();

        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "email_verified_at" => null,
            "current_team_id" => 1,
            "profile_photo_path" => null,
            "is_admin" => 1,
            "password" => bcrypt('12345678'),
        ]);
    }
}
