<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\User;
use App\Member;
use App\Task;

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
        $projects = Project::pluck('id')->toArray();
        $tasks = Task::pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            $task_id =[NULL, $tasks[array_rand($tasks)]];
            Member::create([
                'user_id' => $users[array_rand($users)],
                'project_id' => $projects[array_rand($projects)],
                'task_id' => $task_id[array_rand($task_id)]
            ]);
        }
    }
}
