<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeInformationRequest;
use App\Models\Company;
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
        return view('typeInformation.edit', 
        [
            'typeInformation'=>$typeInformation,
            'companies'=>$companies
        ]);
    }

    public function update(TypeInformationRequest $request, TypeInformation $typeInformation):RedirectResponse
    {
        $typeInformation->update($request->all());
        return redirect()->route('typeInformation.index')->with('success', 'Type Information updated');
    }

    public function destroy(TypeInformation $typeInformation): RedirectResponse
    {
        $typeInformation->delete();
        return redirect()->route('typeInformation.index')->with('danger', 'Type Information deleted');;
    }
}
