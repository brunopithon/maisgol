<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAthleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite a autorização
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $athleteId = $this->athlete_id;

        return [
            'name' => 'sometimes|required|string|max:255',
            'responsible_name' => 'sometimes|required|string|max:255',
            'responsible_CPF' => 'sometimes|required|string|max:14|unique:athletes,responsible_CPF,' . $athleteId,
            'responsible_email' => 'sometimes|required|email|unique:athletes,responsible_email,' . $athleteId,
            'responsible_phone' => 'sometimes|required|string|max:15',
            'cpf' => 'sometimes|required|string|max:14|unique:athletes,cpf,' . $athleteId,
            'height' => 'sometimes|required|numeric',
            'weight' => 'sometimes|required|numeric',
            'birth_date' => 'sometimes|required|date',
            'gender' => 'sometimes|required|in:male,female,others',
            'cep' => 'sometimes|required|string|max:9',
            'street' => 'sometimes|required|string|max:255',
            'number' => 'nullable|string|max:255',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:2',
        ];
    }
}
