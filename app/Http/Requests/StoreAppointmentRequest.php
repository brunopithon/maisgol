<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'coach_id' => 'required|exists:coaches,id',
            'field_id' => 'required|exists:fields,id',
            'group_id' => 'required|exists:groups,id',
            'start_time' => 'required|date_format:H:i:s',
            'day' => 'required|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        ];
    }
}
