<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoachRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permite a autorização
    }


    public function rules(): array
    {
        $coachId = $this->coach_id; // Obtém o ID do treinador da rota

        return [
            'name' => 'sometimes|required|string|max:255',
            'cpf' => 'sometimes|required|string|size:11|unique:coaches,cpf,' . $coachId,
            'status' => 'sometimes|required|in:active,inactive',
            'birth_date' => 'sometimes|required|date',
            'email' => 'sometimes|required|email|unique:coaches,email,' . $coachId,
            'timetable' => 'sometimes|required|array',
        ];
    }
}
