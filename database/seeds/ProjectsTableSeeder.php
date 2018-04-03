<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('projects')) {
            DB::table('projects')->truncate();
        }

        $users = factory(\App\Project::class,20)->create();
    }
}
