<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Model::unguard();
         $tables = [
             'users',
             'projects',
             'features',
             'tasks',
             'todos',
             'members',
             'comments'
         ];
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
         foreach($tables as $table){
             if (Schema::hasTable($table)) {
                 DB::table($table)->truncate();
             }
         }
         $this->call(UsersTableSeeder::class);
         Model::reguard();
    }
}
