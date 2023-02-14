<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //create roles
        $roles = [
            'super_admin',
            'admin',
            'user',
            'editor'
        ];
//= Role::create(['name' => 'admin']);
        //creates permission
        $permissions = [
            'post.create',
            'post.read',
            'post.update',
            'post.delete',
        ];
        //
    }
}
