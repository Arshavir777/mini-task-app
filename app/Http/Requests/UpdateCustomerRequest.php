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
            'first_name' => 'alpha',
            'last_name'  => 'alpha',
            'birth_date' => 'date',
            'country_id' => 'exists:countries,id',
            'profession' => 'required',
            // TODO: check
            'years_in_profession' => 'required_if:profession,!='
        ];
    }
}
