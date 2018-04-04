<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Task;
use App\User;
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('tasks')) {
            DB::table('tasks')->truncate();
        }

        $faker = \Faker\Factory::create('vi_VI');
        $boards = Board::all();
        foreach($boards as $board)
            Task::create([
                'title' => $faker->sentence(mt_rand(4,10),true),
                'dealine' => $faker->dateTimeBetween('+1 week', '+5 month'),
                'board_id' => $board->id,
            ]);
        }
}
