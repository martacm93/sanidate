<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $dateToday = Date::now()->format('Y-m-d');
        return [
            // Controla si los campos vienen vacios o nulos
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'appointment_date' => 'required','before_or_equal:2023-12-31','after_or_equal:'.$dateToday,
            'appointment_time' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'doctor_id.required' => 'The Doctor field is required',
            'patient_id.required' => 'The Patient field is required',
            'appointment_date.required' => 'The Date field is required',
            'appointment_time.required' => 'The Time field is required',
            'appointment_date.max' => 'The date must be before or equal to 2023-12-31 ',
            'appointment_date.min' => 'The date must be after or equal to today',
        ];
    }
}
