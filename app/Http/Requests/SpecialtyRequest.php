<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyRequest extends FormRequest
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
        return [
            'name' => 'required|max:255|unique:specialties,name,' . $this->specialty_id,  
            'active' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'name.max' => 'The name must be less than 255 characters',
            'name.unique' => 'The specialty already exists',
            'active.required' => 'The status field is required',
        ];
    }
}
