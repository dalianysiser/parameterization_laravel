<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeComboInformationRequest;
use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\TypeComboInformation;
use App\Models\TypeInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeComboInformationController extends Controller
{
    public function index(): View
    {
        $typeComboInformation = TypeComboInformation::all();
        return view('typeComboInformation.index', compact('typeComboInformation'));
    }

    public function create(): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $detailTypeInformation = DetailTypeInformation::all();
        return view('typeComboInformation.create', [
            'companies'=>$companies,
            'typeInformations'=>$typeInformations,
            'detailTypeInformation'=>$detailTypeInformation
        ]);
    }

    public function store(TypeComboInformationRequest $request): RedirectResponse
    {
        TypeComboInformation::create($request->all());
        return redirect()->route('typeComboInformation.index')->with('success', 'Type Combo Information created');
    }

    public function show(TypeComboInformation $typeComboInformation): View
    {
        return view('typeComboInformation.show', compact('typeComboInformation'));
    }

    public function edit(TypeComboInformation $typeComboInformation): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $detailTypeInformation = DetailTypeInformation::all();
        return view('typeComboInformation.edit', 
        [
            'companies'=>$companies,
            'detailTypeInformations'=>$detailTypeInformation,
            'typeInformations'=>$typeInformations,
            'typeComboInformation'=>$typeComboInformation
        ]);
    }

    public function update(TypeComboInformationRequest $request, TypeComboInformation $typeComboInformation):RedirectResponse
    {
        $typeComboInformation->update($request->all());
        return redirect()->route('typeComboInformation.index')->with('success', 'Type Combo Information updated');
    }

    public function destroy(TypeComboInformation $typeComboInformation): RedirectResponse
    {
        $typeComboInformation->delete();
        return redirect()->route('typeComboInformation.index')->with('danger', 'Type Combo Information deleted');;
    }
}
