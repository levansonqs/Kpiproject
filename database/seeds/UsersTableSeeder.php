<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('users')) {
                DB::table('users')->truncate();
        }
        DB::table('users')->insert([
            ['name'=>'admin','email' => 'admin@gmail.com','password' => bcrypt('admin@gmail.com'),'remember_token' => str_random(10)]
        ]);
        $users = factory(\App\User::class,100)->create();
    }
}
