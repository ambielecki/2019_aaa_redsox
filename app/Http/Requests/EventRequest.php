<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location' => 'string|required|max:140',
            'type' => 'string|required',
            'date' => 'required',
            'time' => 'required',
            'details.home' => 'different:details.away',
        ];
    }

    public function messages(): array
    {
        return [
            'location.required' => 'Please provide a title',
            'type.required' => 'Please select a type of event',
            'location.max' => 'Maximum Length is 140 characters',
            'details.home.different' => 'Home and Away teams must be different',
        ];
    }
}
