<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequestHttpRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'client_email' => 'bail|required|email',
      'client_name' => 'bail|required|max:200',
      'vehicle_model_id' => 'bail|required|numeric',
      'client_phone' => 'bail|required|alpha_dash',
      'description' => 'bail|required|regex:/^[a-zA-Z\s]*$/|max:10000'
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes() {
    return [
      'client_email' => 'your email',
      'client_name' => 'your name'
    ];
  }
}