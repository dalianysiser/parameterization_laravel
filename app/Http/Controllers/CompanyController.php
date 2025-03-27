<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    
    public function index(Request $request): View
    {
        $searchTerm = $request->input('search');
    
        $query = Company::query();
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%'); // Filtra según el nombre
        }
    
        $companies = $query->orderBy('name', 'ASC')->paginate(10); // 10 resultados por página
    
        return view('company.index', compact('companies', 'searchTerm'));
    }
    

    public function create(): View
    {
        return view('company.create');
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        Company::create($request->all());
        return redirect()->route('company.index')->with('success', 'Company created');
    }

    public function show(Company $company): View
    {
        return view('company.show', compact('company'));
    }

    public function edit(Company $company): View
    {
        return view('company.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company):RedirectResponse
    {
        $company->update($request->all());
        return redirect()->route('company.index')->with('success', 'Company updated');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();
        return redirect()->route('company.index')->with('danger', 'Company deleted');;
    }
}
