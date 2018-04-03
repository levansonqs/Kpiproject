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
        $faker = \Faker\Factory::create('vi_VI');
        if (Schema::hasTable('groups')) {
            DB::table('groups')->truncate();
        }
        $permissions = Permission::pluck('id')->toArray();
        for($i = 1; $i < 10; $i++){
            $permission_id = $permissions[array_rand($permissions)];
            Group::create([
                'name' => $faker->name,
                'permission_id' => $permission_id
            ]);
        }

    }
}
