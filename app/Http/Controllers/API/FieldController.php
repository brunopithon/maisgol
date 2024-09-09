<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * List all fields.
     */
    public function index()
    {
        $fields = Field::all();
        return response()->json($fields, 200);
    }

    /**
     * Show a specific field.
     */
    public function show($id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['message' => 'Field not found'], 404);
        }

        return response()->json($field, 200);
    }

    /**
     * Create a new field.
     */
    public function store(StoreFieldRequest $request)
    {
        $data = $request->validated();

        $field = Field::create($data);

        return response()->json($field, 201);
    }

    /**
     * Update an existing field.
     */
    public function update(UpdateFieldRequest $request, $id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['message' => 'Field not found'], 404);
        }

        $data = $request->validated();
        $field->update($data);

        return response()->json($field, 200);
    }

    /**
     * Delete a specific field.
     */
    public function destroy($id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['message' => 'Field not found'], 404);
        }

        $field->delete();
        return response()->json(['message' => 'Field deleted successfully'], 200);
    }
}
