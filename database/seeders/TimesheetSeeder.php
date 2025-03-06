<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timesheet;

class TimesheetSeeder extends Seeder
{
    public function run()
    {
        Timesheet::create([
            'task_name' => 'Develop login system',
            'date' => now(),
            'hours' => 5,
            'user_id' => 1,
            'project_id' => 1,
        ]);

        Timesheet::create([
            'task_name' => 'Fix dashboard UI',
            'date' => now(),
            'hours' => 3,
            'user_id' => 2,
            'project_id' => 2,
        ]);
    }
}

