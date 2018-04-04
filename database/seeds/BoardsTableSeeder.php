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

        $faker = \Faker\Factory::create('vi_VN');
        $projects = Project::all();
        foreach($projects as $pj){
            for($i = 1; $i < mt_rand(1,3); $i++){
                Board::create([
                    'name' => $faker->name,
                    'description' => $faker->sentence(mt_rand(4,10),true),
                    'project_id' => $pj->id
                ]);
            }
        }
    }
}
