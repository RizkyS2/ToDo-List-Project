<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ToDoList;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ToDoListSeeder extends Seeder
{
    public function run()
    {
        // Jika tidak ingin mengambil data lama, uncomment baris di bawah ini
        DB::table('todo_list')->truncate();

        // Parameter contoh data
        $statuses = ['pending', 'open', 'in_progress', 'completed'];
        $priorities = ['low', 'medium', 'high'];
        $assignees = ['John Doe', 'Jane Smith', 'Alex Johnson', 'Maria Garcia'];

        $data = [];

        for ($i = 1; $i <= 30; $i++) {
            $status = $statuses[array_rand($statuses)];
            $priority = $priorities[array_rand($priorities)];
            $assignee = $assignees[array_rand($assignees)];

            $data[] = [
                'title' => "Task #$i - " . ucfirst($status),
                'description' => "This is a sample description for Task #$i.",
                'assignee' => $assignee,
                'status' => $status,
                'priority' => $priority,
                'time_tracked' => rand(1, 10),
                'due_date' => Carbon::now()->addDays(rand(0, 15)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        ToDoList::insert($data);
    }
}