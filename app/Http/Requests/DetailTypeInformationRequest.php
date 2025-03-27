<?php

namespace App\Http\Requests;

use App\Rules\ConvertCheckboxToInt;
use Illuminate\Foundation\Http\FormRequest;

class DetailTypeInformationRequest extends FormRequest
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
            'detail'=>'required',
            'order'=>'required',
            'field_type_id'=>'required',
            'comesCombo' => ['required', new ConvertCheckboxToInt],
            'is_active' => ['required', new ConvertCheckboxToInt]
        ];
    }
    public function prepareForValidation() { 
        $this->merge([ 'is_active' => $this->is_active === 'on' ? 1 : 0, ]); 
        $this->merge([ 'comesCombo' => $this->comesCombo === 'on' ? 1 : 0, ]); 
    }
}
