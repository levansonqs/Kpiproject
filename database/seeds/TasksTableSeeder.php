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

        $faker = \Faker\Factory::create('vi_VN');
        $boards = Board::all();
        $users = User::select('id')->get()->toArray();
        foreach($boards as $board)
            for($i = 1; $i < mt_rand(2,5); $i++){
                Task::create([
                    'title' => $faker->sentence(mt_rand(4,10),true),
                    'dealine' => $faker->dateTimeBetween('+1 week', '+5 month'),
                    'board_id' => $board->id,
                    'user_id' => array_rand($users)
                ]);
            }

        }
}
