<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Member;
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
        $tasks = Task::pluck('id')->toArray();
        $members = Member::pluck('id')->toArray();
        for($i = 1;$i < mt_rand(1,5); $i++){
            Comment::create([
                'content'=> $faker->sentence(mt_rand(4,20),true),
                'task_id' => $tasks[array_rand($tasks)],
                'member_id' => $members[array_rand($members)],
                'comment_id' => '',
            ]);


        }
        $comments = Comment::pluck('id')->toArray();
        foreach ($comments as $cmt){
            $comment_id =[NULL, $comments[array_rand($comments)]];
            Comment::where('id',$cmt->id)->update([
                'comment_id' => $comment_id
            ]);
        }


    }
}
