<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use App\Models\Coach;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return response()->json($coaches, 200);
    }

    public function show($coach_id)
    {
        $coach = Coach::find($coach_id);

        if (!$coach) {
            return response()->json(['message' => 'Coach not found'], 404);
        }

        return response()->json($coach, 200);
    }

    public function store(StoreCoachRequest $request)
    {
        $data = $request->validated();

        $coach = Coach::create($data);

        return response()->json($coach, 201);
    }

    public function update(UpdateCoachRequest $request, $coach_id)
    {
        $data = $request->validated();

        $coach = Coach::find($coach_id);

        if (!$coach) {
            return response()->json(['message' => 'Coach not found'], 404);
        }

        $coach->update($data);

        return response()->json($coach, 200);
    }
}
