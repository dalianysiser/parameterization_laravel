<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Company;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PersonController extends Controller
{
    public function index(): View
    {
        $people = Person::all();
        return view('person.index', compact('people'));
    }

    public function create(): View
    {
        $companies = Company::all();
        return view('person.create', compact('companies'));
    }

    public function store(PersonRequest $request): RedirectResponse
    {
        Person::create($request->all());
        return redirect()->route('person.index')->with('success', 'Person created');
    }

    public function show(Person $person): View
    {
        return view('person.show', compact('person'));
    }

    public function edit(Person $person): View
    {
        $companies = Company::all();
        return view('person.edit', compact('person', 'companies'));
    }

    public function update(PersonRequest $request, Person $person):RedirectResponse
    {
        $person->update($request->all());
        return redirect()->route('person.index')->with('success', 'Person updated');
    }

    public function destroy(Person $person): RedirectResponse
    {
        $person->delete();
        return redirect()->route('person.index')->with('danger', 'Person deleted');;
    }
}
