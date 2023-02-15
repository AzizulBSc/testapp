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


        for($i=0;$i<count($roles);$i++){
            $result = Role::create(['name'=>$roles[$i]]);
        }

        //creates permission
        $permissions = [
            //Dashboard
            //'dashboard.view',
            //post permission
            'post.create',
            'post.read',
            'post.update',
            'post.delete',
            'post.approve',
            //post permission
            'admin.create',
            'admin.read',
            'admin.update',
            'admin.delete',
            'admin.approve',
            //editor permission
            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'user.approve',
            //editor permission
            'editor.create',
            'editor.read',
            'editor.update',
            'editor.delete',
            'editor.approve',
        ];
        $super_admin = Role::where('name','super_admin')->first();
        for($i=0;$i<count($permissions);$i++){
            $permission = Permission::create(['name'=>$permissions[$i]]);
            $super_admin->givePermissionTo($permission);
            $permission->assignRole($super_admin);
        }
    }
}
