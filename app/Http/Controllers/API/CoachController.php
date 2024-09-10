<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use App\Http\Requests\AvailableCoachRequest;
use App\Models\Coach;

class CoachController extends Controller
{

    public function availableCoaches(AvailableCoachRequest $request)
    {
        $data = $request->validated();

        $start_time = $data['start_time'];
        $day = $data['day'];

        $availableCoaches = Coach::all()->filter(function ($coach) use ($day, $start_time) {
            $timetable = json_decode($coach->timetable, true);
            $hour = date('G', strtotime($start_time));

            return isset($timetable[$day][$hour]) && $timetable[$day][$hour];
        });

        $availableCoaches->each->makeHidden('timetable');

        return response()->json([
            'message' => 'Lista de treinadores disponíveis.',
            'data' => $availableCoaches,
        ], 200);
    }


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

        if (!array_key_exists('timetable', $data)) {
            $defaultTimetable = '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}';

            $data['timetable'] = $defaultTimetable;
        }

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
