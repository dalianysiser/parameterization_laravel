<?php

namespace App\Http\Requests;

use App\Rules\ConvertCheckboxToInt;
use Illuminate\Foundation\Http\FormRequest;

class PersonTypeInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_information_id'=>'required',
            'company_id'=>'required',
            'person_id'=>'required',
            'field_2' =>'date',
            'field_5' => [ new ConvertCheckboxToInt]
        ];
    }

    public function prepareForValidation() { 
        $this->merge([ 'field_5' => $this->is_active === 'on' ? 1 : 0, ]);
    }
}
