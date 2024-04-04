<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Добавляем статус задач
        DB::table('statuses')->insert(['name' => 'Открыта']);
        DB::table('statuses')->insert(['name' => 'Выполнена']);

        // Добавляем задачи
        DB::table('tasks')->insert(['name' => 'Задача 1', 'description' => 'Описание 1', 'status_id' => 2]);
        DB::table('task_statuses')->insert(['task_id' => 1, 'status_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        sleep(1);
        DB::table('task_statuses')->insert(['task_id' => 1, 'status_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        DB::table('tasks')->insert(['name' => 'Задача 2', 'description' => 'Описание 2', 'status_id' => 1]);
        DB::table('task_statuses')->insert(['task_id' => 2, 'status_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        DB::table('tasks')->insert(['name' => 'Задача 3', 'description' => 'Описание 3', 'status_id' => 2]);
        DB::table('task_statuses')->insert(['task_id' => 3, 'status_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        sleep(1);
        DB::table('task_statuses')->insert(['task_id' => 3, 'status_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        DB::table('tasks')->insert(['name' => 'Задача 4', 'description' => 'Описание 4', 'status_id' => 1]);
        DB::table('task_statuses')->insert(['task_id' => 4, 'status_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        
    }
}
