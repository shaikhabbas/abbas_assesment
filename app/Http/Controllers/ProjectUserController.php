<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;


class ProjectUserController extends Controller
{
    /**
     * Assign Project To User.
     * @response message:string
     */    
    public function assignUserToProject(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::findOrFail($request->user_id);
        $project->users()->syncWithoutDetaching([$user->id]);

        return response()->json(['message' => 'User assigned to project successfully']);
    }

    /**
     * Remove User From Project.
     * @response message:string
     */    
    public function removeUserFromProject(Project $project, User $user)
    {
        if (!$project->users()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'User is not assigned to this project'], 404);
        }

        $project->users()->detach($user->id);

        return response()->json(['message' => 'User removed from project']);
    }

  
    public function getUsersByProject(Project $project)
    {
        return response()->json(
            UserResource::collection(User::with('projects')->get())
        );
    }
}
