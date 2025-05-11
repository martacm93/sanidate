<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|confirmed|min:8',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => 'The name field is required',
      'email.required' => 'The email field is required',
      'password.required' => 'The password field is required',
      'password.min' => 'The password must be at least 8 characters',
      'confirmed' => 'The password confirmation does not match',
    ];
    
  }
}
