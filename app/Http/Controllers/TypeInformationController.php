<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeInformationRequest;
use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\PersonTypeInformation;
use App\Models\TypeInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeInformationController extends Controller
{
    public function index(): View
    {
        $typeInformation = TypeInformation::all();
        return view('typeInformation.index', compact('typeInformation'));
    }

    public function create(): View
    {
        $companies = Company::all();
        return view('typeInformation.create', compact('companies'));
    }

    public function store(TypeInformationRequest $request): RedirectResponse
    {
        TypeInformation::create($request->all());
        return redirect()->route('typeInformation.index')->with('success', 'Type Information created');
    }

    public function show(TypeInformation $typeInformation): View
    {
        return view('typeInformation.show', compact('typeInformation'));
    }

    public function edit(TypeInformation $typeInformation): View
    {
        $companies = Company::all();
        return view(
            'typeInformation.edit',
            [
                'typeInformation' => $typeInformation,
                'companies' => $companies
            ]
        );
    }

    public function update(TypeInformationRequest $request, TypeInformation $typeInformation): RedirectResponse
    {
        $typeInformation->update($request->all());
        return redirect()->route('typeInformation.index')->with('success', 'Type Information updated');
    }

    public function destroy(TypeInformation $typeInformation): RedirectResponse
    {
        $typeInformation->delete();
        return redirect()->route('typeInformation.index')->with('danger', 'Type Information deleted');;
    }

    public function getDetailsByType(Request $request)
    {
        $typeInformationId = $request->input('type_information_id');
        $person_id = $request->input('person_id');
        $consecutive = $request->input('consecutive');
        $details = DetailTypeInformation::where('type_information_id', $typeInformationId)->get();

        if ($details->isEmpty()) {
            return response()->json([
                'error' => 'No details found for the selected type information.'
            ], 404);
        }

        $response = [];

        foreach ($details as $detail) {
            $fieldType = $detail->fieldType()->select('id', 'name')->first();

            if (!$fieldType || !$fieldType->name) {
                return response()->json(['error' => 'Invalid field type.'], 400);
            }

            $type = 'text'; // Tipo predeterminado
            $step = null;
            $options = [];
            $fieldName = 'field_1_' . $detail->id;
            $value = null;

        
            switch ($fieldType->name) {
                case 'Varchar':
                    $type = 'text';
                    $value = $this->getValue($person_id, $typeInformationId, $consecutive, $detail->id, 'field_1');
                    break;

                case 'Date':
                    $type = 'date';
                    $fieldName = 'field_2_' . $detail->id;
                    $value = $this->getValue($person_id, $typeInformationId, $consecutive, $detail->id, 'field_2');
                    break;

                case 'Int':
                    $type = 'number';
                    $fieldName = 'field_3_' . $detail->id;
                    $value = $this->getValue($person_id, $typeInformationId, $consecutive, $detail->id, 'field_3');
                    break;

                case 'Decimal':
                    $type = 'number';
                    $step = '0.01';
                    $fieldName = 'field_4_' . $detail->id;
                    $value = $this->getValue($person_id, $typeInformationId, $consecutive, $detail->id, 'field_4');
                    break;

                case 'Check':
                    $type = 'checkbox';
                    $fieldName = 'field_5_' . $detail->id;
                    $value = $this->getValue($person_id, $typeInformationId, $consecutive, $detail->id, 'field_5');
                    break;
            }

           
            if ($detail->comesCombo === 1) {
                $type = 'select';
                $options = $detail->typeComboInformation ?? [];

            }

          
            $response[] = [
                'id' => $detail->id,
                'detail' => $detail->detail,
                'field_type' => $type,
                'field_name' => $fieldName,
                'step' => $step,
                'combo' => $detail->comesCombo,
                'value' => $value,
                'options' => $options // Incluye las opciones del combo con el valor seleccionado
            ];
        }

        return response()->json($response);
    }

  
    private function getValue($person_id, $typeInformationId, $consecutive, $detailId, $fieldName)
    {
        return PersonTypeInformation::where('person_id', $person_id)
            ->where('type_information_id', $typeInformationId)
            ->where('consecutive', $consecutive)
            ->where('detail_type_information_id', $detailId)
            ->value("person_type_information.$fieldName");
    }
}
