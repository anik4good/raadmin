<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model_has_roles = [
            ['role_id' => 1, 'model_type' => 'App\User', 'model_id' => 1],
            ['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 4],
            ['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 2],

        ];


        $roles = [
            ['id' => 1, 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Admin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Member', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];

        $permissions = [
            ['id' => 2, 'name' => 'manage_role', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'manage_permission', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'manage_user', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];



        $role_has_permissions = [
            ['permission_id' => 2, 'role_id' => 1],

        ];


        $users = [
            ['id' => 1, 'name' => 'Super Admin', 'email' => 'admin@mail.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];



//        INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
//    (4, 2),
//(5, 2),
//(5, 4),
//(6, 2),
//(6, 3);



//        DB::table('model_has_roles')->insert(['role_id' => 1, 'model_type' => 'App\User', 'model_id' => 1]);
//        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 4]);
//        DB::table('model_has_roles')->insert(['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 2]);
//        DB::table('model_has_roles')->insert(['role_id' => 4, 'model_type' => 'App\User', 'model_id' => 3]);


        // Query Builder approach
        DB::table('roles')->insert($roles);
        DB::table('permissions')->insert($permissions);
        DB::table('model_has_roles')->insert($model_has_roles);
        DB::table('users')->insert($users);
        //    DB::table('role_has_permissions')->insert($role_has_permissions);
    }
}
