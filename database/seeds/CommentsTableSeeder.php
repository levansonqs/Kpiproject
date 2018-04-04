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
        $faker = \Faker\Factory::create('vi_VI');
        $tasks = Task::all();
        foreach ($tasks as $task) {
            for ($i = 1; $i < mt_rand(1, 5); $i++) {
                Comment::create([
                    'content' => $faker->sentence(mt_rand(4, 20), true),
                    'task_id' => $task->id,
                    'user_id' => mt_rand(1, 100),
                    'comment_id' => NULL,
                ]);
            }
            $comments = Comment::all();
            foreach ($comments as $cmt) {
                for ($i = 1; $i < mt_rand(1, 2); $i++) {
                    Comment::create([
                        'content' => $faker->sentence(mt_rand(4, 20), true),
                        'task_id' => $task->id,
                        'user_id' => mt_rand(1, 100),
                        'comment_id' => $cmt->id,
                    ]);
                }
            }
        }
    }
}
