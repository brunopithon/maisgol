<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{

    public function getFieldAvailability(){

    }

    public function index()
    {
        $fields = Field::all();
        return response()->json($fields, 200);
    }

    public function show($id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['message' => 'Field not found'], 404);
        }

        return response()->json($field, 200);
    }

    public function store(StoreFieldRequest $request)
    {
        $data = $request->validated();

        if (!array_key_exists('timetable', $data)) {
            $defaultTimetable = '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}';

            $data['timetable'] = $defaultTimetable;
          }

        $field = Field::create($data);

        return response()->json($field, 201);
    }

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
