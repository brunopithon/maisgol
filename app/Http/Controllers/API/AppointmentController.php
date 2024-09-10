<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Field;
use App\Models\Coach;

class AppointmentController extends Controller
{
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();

        $fieldAvailability = $this->checkFieldAvailability($data['field_id'], $data['day'], $data['start_time']);

        if (!$fieldAvailability) {
            return response()->json([
                'message' => 'O campo não está disponível no horário selecionado para o dia escolhido.',
            ], 400);
        }

        $coachAvailability = $this->checkCoachAvailability($data['coach_id'], $data['day'], $data['start_time']);

        if (!$coachAvailability) {
            return response()->json([
                'message' => 'O treinador não está disponível no horário selecionado para o dia escolhido.',
            ], 400);
        }

        $appointment = Appointment::create($data);

        $this->updateCoachTimetable($data['coach_id'], $data['day'], $data['start_time']);

        $this->updateFieldTimetable($data['field_id'], $data['day'], $data['start_time']);

        return response()->json([
            'message' => 'Agendamento criado com sucesso.',
            'data' => $appointment->fresh(),
        ], 201);
    }

    public function checkFieldAvailability($field_id, $day, $start_time)
    {
        $field = Field::find($field_id);

        $timetable = json_decode($field->timetable, true);

        $hour = date('G', strtotime($start_time));

        return isset($timetable[$day][$hour]) && $timetable[$day][$hour];
    }

    public function checkCoachAvailability($coach_id, $day, $start_time)
    {
        $coach = Coach::find($coach_id);

        $timetable = json_decode($coach->timetable, true);

        $hour = date('G', strtotime($start_time));

        return isset($timetable[$day][$hour]) && $timetable[$day][$hour];
    }

    protected function updateFieldTimetable($field_id, $day, $start_time)
    {
        $field = Field::find($field_id);

        if (!$field) {
            return false;
        }

        $timetable = json_decode($field->timetable, true);

        $hour = date('G', strtotime($start_time));

        if (isset($timetable[$day][$hour])) {
            $timetable[$day][$hour] = false;
        }

        $field->timetable = json_encode($timetable);
        $field->save();

        return true;
    }

    protected function updateCoachTimetable($coach_id, $day, $start_time)
    {
        $coach = Coach::find($coach_id);

        if (!$coach) {
            return false;
        }

        $timetable = json_decode($coach->timetable, true);

        $hour = date('G', strtotime($start_time));

        if (isset($timetable[$day][$hour])) {
            $timetable[$day][$hour] = false;
        }

        $coach->timetable = json_encode($timetable);
        $coach->save();

        return true;
    }

    public function index()
    {
        $appointments = Appointment::with(['field', 'coach'])->get();

        return response()->json([
            'message' => 'Lista de agendamentos recuperada com sucesso.',
            'data' => $appointments,
        ], 200);
    }
}
