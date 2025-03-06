<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
   /**
 * Get all projects with optional filters.
 */
    public function index(Request $request)
    {
        

        $query = Project::query();

        // Regular field filters
        if ($request->has('filters')) {
            foreach ($request->filters as $field => $value) {
                if (in_array($field, ['name', 'status'])) {
                    $query->where($field, 'LIKE', "%$value%");
                }
            }
        }

        // EAV filtering
        if ($request->has('filters')) {
            foreach ($request->filters as $attributeName => $value) {
                if (!in_array($attributeName, ['name', 'status'])) {
                    $attribute = Attribute::where('name', $attributeName)->first();
                    if ($attribute) {
                        $query->whereHas('attributeValues', function ($q) use ($attribute, $value) {
                            $q->where('attribute_id', $attribute->id)
                                ->where('value', 'LIKE', "%$value%");
                        });
                    }
                }
            }
        }

        return response()->json($query->with('attributeValues.attribute')->get());
    }

    
    public function show($id)
    {
        return response()->json(Project::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:projects,name',
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|unique:projects,name,' . $project->id,
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        $project->update($request->all());

        return response()->json(['message' => 'Project updated successfully', 'project' => $project]);
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return response()->json(['message' => 'Project deleted']);
    }
}
