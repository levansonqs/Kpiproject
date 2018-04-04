<?php

use Illuminate\Database\Seeder;
use App\Project;
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
        $faker = \Faker\Factory::create('vi_VI');
        $members = \App\Member::all();
            foreach ($members as $mem){
                for($i = 1;$i < mt_rand(1,3); $i++){
                    Project::create([
                    'name' => $faker->domainName,
                    'dealine' => $faker->dateTimeBetween('+1 week', '+5 month'),
                    'member_id' => $mem->id,
                    'permission_id' => mt_rand(1,3)
                ]);
            }
        }
    }
}
