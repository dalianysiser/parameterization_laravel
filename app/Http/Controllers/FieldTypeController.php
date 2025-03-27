<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldTypeRequest;
use App\Models\FieldType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FieldTypeController extends Controller
{
    public function index(): View
    {
        $fieldType = FieldType::all();
        return view('fieldType.index', compact('fieldType'));
    }

    public function create(): View
    {
        return view('fieldType.create');
    }

    public function store(FieldTypeRequest $request): RedirectResponse
    {
        FieldType::create($request->all());
        return redirect()->route('fieldType.index')->with('success', 'Field Type created');
    }

    public function show(FieldType $fieldType): View
    {
        return view('fieldType.show', compact('fieldType'));
    }

    public function edit(FieldType $fieldType): View
    {
        return view('fieldType.edit', compact('fieldType'));
    }

    public function update(FieldTypeRequest $request, FieldType $fieldType):RedirectResponse
    {
        $fieldType->update($request->all());
        return redirect()->route('fieldType.index')->with('success', 'Field Type updated');
    }

    public function destroy(FieldType $fieldType): RedirectResponse
    {
        $fieldType->delete();
        return redirect()->route('fieldType.index')->with('danger', 'Field Type deleted');;
    }
}
