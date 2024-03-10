<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'string|max:10|nullable',
            'last_name' => 'string|max:10|nullable',
            'birth_date' => 'date|nullable',
            'country_id' => 'exists:countries,id|nullable',
            'years_in_profession' => 'required_if:profession,!=|nullable|numeric|min:0'
        ];
    }
}
