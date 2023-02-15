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
//        $user = User::where('email','azizulh8774@gamil.com')->first();
        DB::table('users')->truncate();
        $user = User::where('email','azizulh8774@gamil.com')->first();
        if(is_null($user)){
            $user = new User();
            $user->name = "Azizul Hoque";
            $user->email = "azizulh8774@gamil.com";
            $user->password = Hash::make("12345678");
            $user->save();
        }

           $users = [];
           for ($i = 1; $i <= 20000; $i++) {
               $name = 'User ' . $i;
               $email = Str::slug($name) . '.' . Str::random(10) . '@example.com';
               $users[] = [
                   'name' => $name,
                   'email' => $email,
                   'password' => bcrypt('password'),
               ];
           }
           DB::table('users')->insert($users);
    }
}
