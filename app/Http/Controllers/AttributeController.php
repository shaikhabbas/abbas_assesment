<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    /**
    * Get all attributes.
    * @response Attribute[]
    */
    public function index()
    {
        return response()->json(
            Attribute::all(), 
            200);
    }

    /**
    * Show attributes.
    * @response Attribute
    */
    public function show($id)
    {
        return response()->json(Attribute::findOrFail($id));
    }

    /**
    * Store attributes.
    * @response Attribute
    */
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
    
    /**
    * Update attributes from id.
    * @response Attribute
    */

    public function update(Request $request,int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'null',
            'type' => 'null',
        ]);
        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->all());
        return response()->json($attribute);
    }

    /**
    * Update attributes.
    * @response Attribute
    */
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

    /**
    * Destory attributes.
    * @response message:string
    */
    public function destroy($id)
    {
        Attribute::destroy($id);
        return response()->json(['message' => 'Attribute deleted']);
    }
}

