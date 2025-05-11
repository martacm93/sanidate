<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ChangePassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatient extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
      
      if($this->new_password == null){
        return [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255'];
        }else{
          return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'old_password' => ['required', new ChangePassword(User::find($this->user_id))],
            'new_password' => 'confirmed|min:8',
          ];
        }
    }
    public function messages()
    {
      return [
        'name.required' => 'The name field is required',
        'email.required' => 'The email field is required',
        'old_password.current_password' => 'The password is incorrect',
        'old_password.required_with' => 'The old password field is required',
        'new_password.min' => 'The password must be at least 8 characters',
        'confirmed' => 'The password confirmation does not match',
      ];
    }
}
