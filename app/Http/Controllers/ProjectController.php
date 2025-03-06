<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProjectFilterRequest;
use App\Http\Resources\ProjectAttributesResource;


class ProjectController extends Controller
{
   /**
 * Get all projects with optional filters.
 * 
 * To filter data add filter in the field in object for like below object.  
 * {
 *  "name":"ProjectA", 
 *  "Department":"IT"
 * }
 */
    public function index(ProjectFilterRequest $request)
    {
        $query = Project::query();

        // Regular field filters
        if ($request->filled('filters')) {
            foreach ($request->filters as $field => $value) {
                if (in_array($field, ['name', 'status'])) {
                    $query->where($field, 'LIKE', "%$value%");
                }
            }
        }

        // EAV filtering
        if ($request->filled('filters')) {
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

        

        return ProjectAttributesResource::collection($query->with('attributeValues.attribute')->get());
    }

    /**
    * Show Project.
    * @response Project
    */
    public function show($id)
    {
        return response()->json(Project::findOrFail($id));
    }

    /**
    * Store Project.
    * @response Project
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:projects,name',
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }
    /**
    * Update Project.
    * @response Project
    */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|unique:projects,name,' . $project->id,
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        $project->update($request->all());

        return response()->json(['message' => 'Project updated successfully', 'project' => $project]);
    }

    /**
    * Destory Project.
    * @response message:string
    */
    public function destroy($id)
    {
        Project::destroy($id);
        return response()->json(['message' => 'Project deleted']);
    }
}
