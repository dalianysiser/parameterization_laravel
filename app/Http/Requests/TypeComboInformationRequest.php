<?php

namespace App\Http\Requests;

use App\Rules\ConvertCheckboxToInt;
use Illuminate\Foundation\Http\FormRequest;

class TypeComboInformationRequest extends FormRequest
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
            'company_id'=>'required',
            'type'=>'required',
            'type_information_id'=>'required',
            'detail_type_information_id'=>'required',
            'is_active' => ['required', new ConvertCheckboxToInt]
        ];
    }

    public function prepareForValidation() { 
        $this->merge([ 'is_active' => $this->is_active === 'on' ? 1 : 0, ]);
    }
}
