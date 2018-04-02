<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\Board;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('boards')) {
            DB::table('boards')->truncate();
        }

        $faker = \Faker\Factory::create('vi_VI');
        $projects = Project::pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++){
            $project_id = $projects[array_rand($projects)];
            Board::create([
                'name' => $faker->name,
                'description' => $faker->sentence(mt_rand(4,10),true),
                'project_id' => $project_id
            ]);
        }
    }
}
