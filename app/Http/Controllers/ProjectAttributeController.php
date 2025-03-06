<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Project;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class ProjectAttributeController extends Controller
{
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

    public function getProjectWithAttributes(Project $project)
    {
        $attributes = $project->attributes()->get();
        return response()->json([
            /**
             * @var Project
             */
            'project' => $project,
            /**
             * @var Attribute
             */
            'attributes' => $attributes
        ], 200);
    }

    public function filterProjectsByAttribute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $projects = Project::whereHas('attributes', function ($query) use ($request) {
            $query->where('attribute_id', $request->attribute_id)
                  ->where('value', $request->value);
        })->get();

        return response()->json(
            /**
             * @var Project
             */
            $projects, 
            200);
    }
}

