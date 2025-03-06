<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'ProjectA',
            'status' => 'pending',
        ]);

        Project::create([
            'name' => 'CRM System',
            'status' => 'completed',
        ]);
    }
}

