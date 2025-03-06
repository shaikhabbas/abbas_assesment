<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Project;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class ProjectAttributeController extends Controller
{
    /**
 * Set Attributes for project.
 * @response message:string
 */
    public function setAttributes(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'attributes' => 'required|array',
            'attributes.*.attribute_id' => 'required|exists:attributes,id',
            'attributes.*.value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        foreach ($request->attributes as $attr) {
            AttributeValue::updateOrCreate(
                [
                    'attribute_id' => $attr['attribute_id'],
                    'entity_id' => $project->id
                ],
                ['value' => $attr['value']]
            );
        }

        return response()->json(['message' => 'Attributes updated successfully'], 200);
    }

     /**
 * Get Attributes for project.
 */
    public function getProjectWithAttributes(Project $project)
    {
        $attributes = $project->attributes()->get();
        return response()->json([
            /**
             * @var Project
             */
            'project' => $project,
            /**
             * @var Attribute[]
             */
            'attributes' => $attributes
        ], 200);
    }

    /**
     * Filter Projects by Attributes.
     * @response Project[]
     */
    public function filterProjectsByAttribute(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'attribute_name' => 'required|exists:attributes,name',
            'value' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $projects = Project::whereHas('attributeValues', function ($query) use ($request) {
            $query->whereHas('attribute', function ($attributeQuery) use ($request) {
                $attributeQuery->where('name', $request->attribute_name); 
            });
        
            if ($request->filled('value')) { 
                $query->where('value', 'LIKE', "%{$request->value}%");
            }
        })->get();
        
        

        if ($projects->isEmpty()) {
            return response()->json(['message' => 'No projects found matching the criteria'], 404);
        }

        return response()->json($projects, 200);
    }

}

