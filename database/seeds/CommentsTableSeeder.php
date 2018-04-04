<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Comment;
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('comments')) {
            DB::table('comments')->truncate();
        }
        $faker = \Faker\Factory::create('vi_VN');
        $tasks = Task::all();
        $users = \App\User::select('id')->get()->toArray();
        foreach ($tasks as $task) {
            for ($i = 1; $i < mt_rand(1, 2); $i++) {
                Comment::create([
                    'content' => $faker->sentence(mt_rand(4, 20), true),
                    'task_id' => $task->id,
                    'user_id' => array_rand($users),
                    'comment_id' => NULL,
                ]);
            }
        }
    }
}
