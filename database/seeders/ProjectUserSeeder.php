<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectUserSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $projects = Project::all();

        if ($users->isEmpty() || $projects->isEmpty()) {
            return; // Avoid errors if users or projects don't exist
        }

        foreach ($users as $user) {
            $assignedProjects = $projects->random(rand(1, 2)); // Assign 1-2 random projects to each user
            foreach ($assignedProjects as $project) {
                DB::table('project_user')->insert([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
