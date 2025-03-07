<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
    * Get all attribute Values.
    * @response AttributeValue[]
    */
    public function index()
    {
        return response()->json(AttributeValue::all());
    }

    /**
    * Show attribute Values.
    * @response AttributeValue
    */
    public function show($id)
    {
        return response()->json(AttributeValue::findOrFail($id));
    }

    /**
    * Store attribute Values.
    * @response AttributeValue
    */
    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'entity_id' => 'required|exists:projects,id',
            'value' => 'required',
        ]);

        $attributeValue = AttributeValue::create($request->all());

        return response()->json($attributeValue, 201);
    }

    /**
    * Update attribute Values.
    * @response AttributeValue
    */
    public function update(Request $request, $id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->update($request->all());
        return response()->json($attributeValue);
    }

    /**
    * Show attribute Values.
    * @response message:string
    */
    public function destroy($id)
    {
        AttributeValue::destroy($id);
        return response()->json(['message' => 'Attribute Value deleted']);
    }
}
