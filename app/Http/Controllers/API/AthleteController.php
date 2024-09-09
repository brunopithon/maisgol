<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAthleteRequest;
use App\Http\Requests\UpdateAthleteRequest;
use App\Models\Athlete;

class AthleteController extends Controller
{
    public function index()
    {
        $athletes = Athlete::all();
        return response()->json($athletes, 200);
    }

    public function show($athlete_id)
    {
        $athlete = Athlete::find($athlete_id);

        if (!$athlete) {
            return response()->json(['message' => 'Athlete not found'], 404);
        }

        return response()->json($athlete, 200);
    }

    public function store(StoreAthleteRequest $request)
    {
        $data = $request->validated();

        $athlete = Athlete::create($data);

        return response()->json($athlete, 201);
    }

    public function update(UpdateAthleteRequest $request, $athlete_id)
    {
        $data = $request->validated();

        $athlete = Athlete::find($athlete_id);

        if (!$athlete) {
            return response()->json(['message' => 'Athlete not found'], 404);
        }

        $athlete->update($data);

        return response()->json($athlete, 200);
    }
}
