<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = new User();
        $users->name = "Nolan";
        $users->email = "nolan@incredible.com";
        $users->password = Hash::make("nolan123");
        $users->phone = 0515232502;
        $users->age = 20;
        $users->save();
    }
}
