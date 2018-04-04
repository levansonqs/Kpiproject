<?php

use Illuminate\Database\Seeder;
use App\Group;
use App\Permission;
class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');
        if (Schema::hasTable('groups')) {
            DB::table('groups')->truncate();
        }
        for($i = 1; $i < 20; $i++){
            Group::create([
                'name' => $faker->name
            ]);
        }

    }
}
