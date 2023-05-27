<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
            $result = Role::create(['name'=>$roles[$i],'guard_name'=>'admin']);
        }

        //creates permission
        $permissions = [
            [
                'group_name'=>'dashboard',
                'permissions'=>[
                    'dashboard.view',
                    'dashboard.edit',
                    ]
            ],
            [
                'group_name'=>'post',
                'permissions'=>[
                    'post.create',
                    'post.read',
                    'post.update',
                    'post.delete',
                    'post.approve',
                ]
            ],
            [
                'group_name'=>'admin',
                'permissions'=>[
                    'admin.create',
                    'admin.read',
                    'admin.update',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            [
                'group_name'=>'user',
                'permissions'=>[
                    'user.create',
                    'user.read',
                    'user.update',
                    'user.delete',
                    'user.approve',
                ]
            ],
            [
                'group_name'=>'editor',
                'permissions'=>[
                    'editor.create',
                    'editor.read',
                    'editor.update',
                    'editor.delete',
                    'editor.approve',
                ]
            ],

        ];
        $super_admin = Role::where('name','super_admin')->first();
        for($i=0;$i<count($permissions);$i++){
            $group_name = $permissions[$i]['group_name'];
            for ($j=0;$j<count($permissions[$i]['permissions']);$j++){
                $permission = Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=>$group_name,'guard_name'=>'admin']);
                $super_admin->givePermissionTo($permission);
                $permission->assignRole($super_admin);
            }

        }
    }
}
