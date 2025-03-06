<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index()
    {
        return response()->json(Attribute::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Attribute::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:attributes,name',
            'type' => 'required|in:text,date,number,select',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attribute = Attribute::create($request->all());
        return response()->json($attribute, 201);
    }
    
    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->all());
        return response()->json($attribute);
    }

    public function updateAtr(Request $request, Attribute $attribute)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:attributes,name,' . $attribute->id,
            'type' => 'required|in:text,date,number,select',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attribute->update($request->all());
        return response()->json($attribute, 200);
    }

    public function destroy($id)
    {
        Attribute::destroy($id);
        return response()->json(['message' => 'Attribute deleted']);
    }
}

