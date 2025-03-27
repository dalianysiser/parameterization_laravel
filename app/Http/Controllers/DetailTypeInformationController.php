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
            'companies'=>$companies,
            'typeInformations'=>$typeInformations,
            'fieldTypes'=>$fieldTypes
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
        return view('detailTypeInformation.edit', 
        [
            'companies'=>$companies,
            'detailTypeInformation'=>$detailTypeInformation,
            'typeInformations'=>$typeInformations,
            'fieldTypes'=>$fieldTypes
        ]);
    }

    public function update(DetailTypeInformationRequest $request, DetailTypeInformation $detailTypeInformation):RedirectResponse
    {
        $detailTypeInformation->update($request->all());
        return redirect()->route('detailTypeInformation.index')->with('success', 'Detail Type Information updated');
    }

    public function destroy(DetailTypeInformation $detailTypeInformation): RedirectResponse
    {
        $detailTypeInformation->delete();
        return redirect()->route('detailTypeInformation.index')->with('danger', 'Detail Type Information deleted');;
    }
}
