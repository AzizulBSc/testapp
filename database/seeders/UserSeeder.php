<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $user = new User();
            $user->name = "Azizul Hoque";
            $user->email = "azizulh8774@gamil.com";
            $user->password = Hash::make("12345678");
            $user->save();
            User::factory()->count(200)->create();
    }
}
