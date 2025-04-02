<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailTypeInformationRequest;
use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\FieldType;
use App\Models\TypeInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DetailTypeInformationController extends Controller
{
    public function index(): View
    {
        $detailTypeInformation = DetailTypeInformation::all();
        return view('detailTypeInformation.index', compact('detailTypeInformation'));
    }

    public function create(): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $fieldTypes = FieldType::all();
        return view('detailTypeInformation.create', [
            'companies' => $companies,
            'typeInformations' => $typeInformations,
            'fieldTypes' => $fieldTypes
        ]);
    }

    public function store(DetailTypeInformationRequest $request): RedirectResponse
    {
        DetailTypeInformation::create($request->all());
        return redirect()->route('detailTypeInformation.index')->with('success', 'Detail Type Information created');
    }

    public function show(DetailTypeInformation $detailTypeInformation): View
    {
        return view('detailTypeInformation.show', compact('detailTypeInformation'));
    }

    public function edit(DetailTypeInformation $detailTypeInformation): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $fieldTypes = FieldType::all();
        return view(
            'detailTypeInformation.edit',
            [
                'companies' => $companies,
                'detailTypeInformation' => $detailTypeInformation,
                'typeInformations' => $typeInformations,
                'fieldTypes' => $fieldTypes
            ]
        );
    }

    public function update(DetailTypeInformationRequest $request, DetailTypeInformation $detailTypeInformation): RedirectResponse
    {
        $detailTypeInformation->update($request->all());
        return redirect()->route('detailTypeInformation.index')->with('success', 'Detail Type Information updated');
    }

    public function destroy(DetailTypeInformation $detailTypeInformation): RedirectResponse
    {
        $detailTypeInformation->delete();
        return redirect()->route('detailTypeInformation.index')->with('danger', 'Detail Type Information deleted');;
    }

    public function getFieldType(Request $request)
    {
        $detailId = $request->input('detail_id');

       
        $detail = DetailTypeInformation::find($detailId);

        if (!$detail) {
            return response()->json([
                'error' => 'Detail Type Information not found.'
            ], 404);
        }

        $type = 'text';
        $step = null;
        $options = [];
        $fieldName = 'field_1'; 
        switch ($detail->fieldType->name) {
            case 'Date':
                $type = 'date';
                $fieldName = 'field_2'; 
                break;
            case 'Int':
                $type = 'number';
                $fieldName = 'field_3'; 
                break;
            case 'Decimal':
                $type = 'number';
                $step = '0.01';
                $fieldName = 'field_4'; 
                break;
            case 'Check':
                $type = 'checkbox';
                $fieldName = 'field_5'; 
                break;
        }

        
        if ($detail->comesCombo === 1) {
            $type = 'select';

            $options = $detail->typeComboInformation;
        }

        return response()->json([
            'field_type' => $type,
            'field_name' => $fieldName,
            'step' => $step,
            'combo' => $detail->comesCombo,
            'options' => $options
        ]);
    }

}
