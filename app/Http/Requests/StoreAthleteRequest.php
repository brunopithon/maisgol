<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAthleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'responsible_name' => 'required|string|max:255',
            'responsible_CPF' => 'required|string|max:14|unique:athletes,responsible_CPF',
            'responsible_email' => 'required|email|unique:athletes,responsible_email',
            'responsible_phone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:athletes,cpf',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,others',
            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'number' => 'nullable|string|max:255',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
        ];
    }
}
