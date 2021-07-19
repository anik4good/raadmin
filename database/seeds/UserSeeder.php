<?php

namespace Database\Seeders;

use App\Setting;
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
            ['id' => 1, 'name' => 'SuperAdmin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Admin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'User', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];

        $permissions = [
            ['id' => 2, 'name' => 'manage_role', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'manage_permission', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'manage_user', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'name' => 'manage_profile', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'name' => 'manage_backup', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];


        $role_has_permissions = [
            ['permission_id' => 5, 'role_id' => 3],
            ['permission_id' => 4, 'role_id' => 2],

        ];


        $users = [
            ['id' => 1, 'name' => 'Anik Mustafa', 'email' => 'admin@mail.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'john Doe', 'email' => 'user@mail.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];


        $profiles = [
            [
                'user_id' => 1,
                'gender'=>'Male',
                'phone'=>'01775727429',
                'occupation'=>'Software Engineer',
                'about'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid eaque excepturi
                                   expedita explicabo fugit nostrum quibusdam sequi ut veritatis vitae? Cum debitis eos
                                   excepturi nulla quod repudiandae sunt tempora ullam.',
                'address'=>'Gulshan Badda link Road',
                'city'=>'Dhaka',
                'post_code'=>'1212',
                'country'=>'Bangladesh',
                'state'=>'Dhaka',
                'facebook'=>'nik4good',
                'twitter'=>'',
                'instagram'=>'nik4nobody',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'user_id' => 2,
                'gender'=>'Male',
                'phone'=>'017545454545',
                'occupation'=>'Student',
                'about'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid eaque excepturi
                                   expedita explicabo fugit nostrum quibusdam sequi ut veritatis vitae? Cum debitis eos
                                   excepturi nulla quod repudiandae sunt tempora ullam.',
                'address'=>'Gulshan Badda link Road',
                'city'=>'Dhaka',
                'post_code'=>'1215',
                'country'=>'Bangladesh',
                'state'=>'Dhaka',
                'facebook'=>'',
                'twitter'=>'',
                'instagram'=>'',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


        ];

        // General Settings
        $settings = [
            ['name' => 'site_title', 'value' => 'TECHNIK'],
            ['name' => 'site_description', 'value' => 'Your Starter kit'],
            // Logo Settings
            ['name' => 'site_logo', 'value' => null],
            ['name' => 'site_favicon', 'value' => null],
            // Mail Settings
            ['name' => 'mail_mailer', 'value' => 'smtp'],
            ['name' => 'mail_host', 'value' => 'smtp.mailtrap.io'],
            ['name' => 'mail_port', 'value' => '2525'],
            ['name' => 'mail_username', 'value' => ''],
            ['name' => 'mail_password', 'value' => ''],
            ['name' => 'mail_encryption', 'value' => 'TLS'],
            ['name' => 'mail_from_address', 'value' => ''],
            ['name' => 'mail_from_name', 'value' => 'Technik'],

            // Socialite Settings
            ['name' => 'facebook_client_id', 'value' => null],
            ['name' => 'facebook_client_secret', 'value' => null],

            ['name' => 'google_client_id', 'value' => null],
            ['name' => 'google_client_secret', 'value' => null],

            ['name' => 'github_client_id', 'value' => null],
            ['name' => 'github_client_secret', 'value' => null],
        ];


        // Query Builder approach
        DB::table('roles')->insert($roles);
        DB::table('permissions')->insert($permissions);
        DB::table('model_has_roles')->insert($model_has_roles);
        DB::table('users')->insert($users);
        DB::table('profiles')->insert($profiles);
        DB::table('role_has_permissions')->insert($role_has_permissions);
        DB::table('settings')->insert($settings);


    }
}
