<?php
namespace App\Http\Requests;

use App\Rules\ConvertCheckboxToInt;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeInformationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta esto según tus necesidades de autorización
    }

    public function rules(): array
    {
        $id = $this->route('typeInformation'); // Obtén el ID del registro que se está editando

        $rules = [
            'company_id' => 'required',
            'codTypeInformation' => [
                'required',
                Rule::unique('type_information')->ignore($id)->where(function ($query) {
                    return $query->where('company_id', $this->company_id)
                                 ->where('typeInformation', $this->typeInformation);
                }),
            ],
            'typeInformation' => 'required',
            'is_singleRegistry' => ['required', new ConvertCheckboxToInt],
            'is_active' => ['required', new ConvertCheckboxToInt],
        ];

        if ($this->isMethod('post')) {
            $rules['codTypeInformation'] = [
                'required',
                Rule::unique('type_information')->where(function ($query) {
                    return $query->where('company_id', $this->company_id)
                                 ->where('typeInformation', $this->typeInformation);
                }),
            ];
        }

        return $rules;
    }

    public function prepareForValidation() { 
        // Convierte "on" a 1 y cualquier otro valor a 0 antes de validar 
        $this->merge([ 'is_singleRegistry' => $this->is_singleRegistry === 'on' ? 1 : 0, ]); 
        $this->merge([ 'is_active' => $this->is_active === 'on' ? 1 : 0, ]); 
    }
}
