<?php

use App\User;
use Database\Seeders\UserSeeder;
    use Database\Seeders\UserSeederLocal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  $this->call(UserSeeder::class);
     //   $user = User::factory()->make(100);
        $this->call(UserSeederLocal::class);


    }
}
