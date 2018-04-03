<?php

use Illuminate\Database\Seeder;
use App\Todo;
use App\Task;
class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('todos')) {
            DB::table('todos')->truncate();
        }

        $faker = \Faker\Factory::create('vi_VI');
        $tasks = Task::pluck('id')->toArray();
        for($i = 1;$i < mt_rand(1,5); $i++){
            Todo::create([
                'content'=> $faker->sentence(mt_rand(4,20),true),
                'task_id' => $tasks[array_rand($tasks)]
            ]);
        }
    }
}
