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
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
         $this->call(PermissionsTableSeeder::class);
         $this->call(GroupsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
        $this->call(MembersTableSeeder::class);
         $this->call(ProjectsTableSeeder::class);
        $this->call(BoardsTableSeeder::class);
         $this->call(TasksTableSeeder::class);
         $this->call(TodosTableSeeder::class);
         $this->call(CommentsTableSeeder::class);




         DB::statement('SET FOREIGN_KEY_CHECKS=1');
         Model::reguard();
    }
}
