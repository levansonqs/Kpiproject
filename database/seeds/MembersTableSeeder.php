<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\User;
use App\Member;
use App\Task;
use App\Group;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('members')) {
            DB::table('members')->truncate();
        }
        $users = User::pluck('id')->toArray();
        $groups = Group::pluck('id')->toArray();
        foreach ($users as $key => $u){
            for ($i = 1; $i < 3; $i++) {
                Member::create([
                    'user_id' => $u,
                    'group_id' => $groups[array_rand($groups)],
                ]);
            }
        }
        foreach ($groups as $key => $gr){
            for ($i = 1; $i < 3; $i++) {
                Member::create([
                    'user_id' => $users[array_rand($users)],
                    'group_id' => $gr
                ]);
            }
        }
    }
}
