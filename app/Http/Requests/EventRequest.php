<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest {
  public function authorize(): bool {
    return true;
  }

  public function rules(): array {
    return [
      'title' => 'string|required|max:140',
    ];
  }

  public function messages(): array {
    return [
      'title.required'       => 'Please provide a title',
      'title.max'            => 'Maximum Length is 140 characters',
    ];
  }
}
