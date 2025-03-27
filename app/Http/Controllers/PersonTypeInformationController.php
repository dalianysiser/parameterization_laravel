<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonTypeInformationRequest;
use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\Person;
use App\Models\PersonTypeInformation;
use App\Models\TypeInformation;
use App\Services\DynamicFieldService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class PersonTypeInformationController extends Controller
{
    protected $dynamicFieldService;

    public function __construct(DynamicFieldService $dynamicFieldService) 
    { 
        $this->dynamicFieldService = $dynamicFieldService; 
    }
    public function index(Request $request): View
{
    $searchTerm = $request->input('search');

    // Crear una consulta base
    $query = PersonTypeInformation::query();

    if ($request->filled('search')) {
        $columns = Schema::getColumnListing('person_type_information');

        // Búsqueda en los campos de la tabla principal
        $query->where(function ($q) use ($columns, $searchTerm) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $searchTerm . '%');
            }
        });

        $query->orWhereHas('person', function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%');
        })->orWhereHas('company', function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%');
        })->orWhereHas('typeInformation', function ($q) use ($searchTerm) {
            $q->where('typeInformation', 'LIKE', '%' . $searchTerm . '%');
        })->orWhereHas('detailTypeInformation', function ($q) use ($searchTerm) {
            $q->where('detail', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    $personTypeInformation = $query->paginate(10);

    return view('personTypeInformation.index', compact('personTypeInformation', 'searchTerm'));
}


    public function create(): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $detailTypeInformation = DetailTypeInformation::all();
        $person= Person::all();
        return view('personTypeInformation.create', [
            'companies'=>$companies,
            'detailTypeInformations'=>$detailTypeInformation,
            'typeInformations'=>$typeInformations,
            'people'=> $person
        ]);
    }

    public function createFilter(PersonTypeInformation $personTypeInformation): View
    {
        $companyId = $personTypeInformation->company_id;
        $personId =$personTypeInformation->person_id;
        $typeInformationId = $personTypeInformation->type_information_id;

        $company = Company::findOrFail($companyId);
        $person = Person::findOrFail($personId);
        $typeInformation = TypeInformation::findOrFail($typeInformationId);

        $lastConsecutive = PersonTypeInformation::where('company_id', $company->id)
                                                ->where('person_id', $person->id)
                                                ->where('type_information_id', $typeInformation->id)
                                                ->orderBy('consecutive', 'DESC')
                                                ->value('consecutive');

        $consecutive = $lastConsecutive ? $lastConsecutive + 1 : 1;

        $details = DetailTypeInformation::where('company_id', $company->id)
                                        ->where('type_information_id', $typeInformation->id)
                                        ->orderBy('order', 'ASC')
                                        ->with(['typeComboInformation' => function ($query) use ($companyId) {
                                            $query->where('company_id', $companyId);
                                        }])
                                        ->get();

        return view('personTypeInformation.createFilter', [
            'company' => $company,
            'detailTypeInformations' => $details,
            'typeInformation' => $typeInformation,
            'person' => $person,
            'consecutive' => $consecutive
        ]);
    }

    public function storeFilter(Request $request): RedirectResponse
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (strpos($key, 'field_') === 0) {
                $field = explode('_', $key);
                $person = Person::find($data['person']);
                if (!$person || !$person->company) {
                    return redirect()->back()->withErrors(['company' => 'Company not found for the selected person.']);
                }
               
                $companyId = $person->company->id;
                
                $personTypeInformation = PersonTypeInformation::create([
                    'company_id' => $companyId,
                    'person_id' => $data['person'],
                    'type_information_id' => $data['typeinformation'],
                    'consecutive' => $data['consecutive'],
                    'detail_type_information_id' => $field[2],
                    $field[0].'_'.$field[1] => $value,
                ]);           
            }
        }

        return redirect()->route('personTypeInformation.index')->with('success', 'Person Type Information created');
    }


    public function store(PersonTypeInformationRequest $request): RedirectResponse
    {
        PersonTypeInformation::create($request->all());
        return redirect()->route('personTypeInformation.index')->with('success', 'Person Type Information created');
    }

    public function show(PersonTypeInformation $personTypeInformation): View
    {
        return view('personTypeInformation.show', compact('personTypeInformation'));
    }

    public function edit(PersonTypeInformation $personTypeInformation): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $detailTypeInformation = DetailTypeInformation::all();
        $people= Person::all();
        return view('personTypeInformation.edit', 
        [
            'companies'=>$companies,
            'detailTypeInformations'=>$detailTypeInformation,
            'typeInformations'=>$typeInformations,
            'personTypeInformation'=>$personTypeInformation,
            'people'=> $people
        ]);
    }

    public function editFilter(PersonTypeInformation $personTypeInformation): View
    {
        $companies = Company::all();
        $typeInformations = TypeInformation::all();
        $detailTypeInformation = DetailTypeInformation::all();
        $people= Person::all();
        
        $personTypeInformationOrden = PersonTypeInformation::select(
            'person_type_information.*', // Selecciona todos los campos de person_type_information
            'detail_type_information.id AS detail_type_information_id',
            'detail_type_information.order AS detail_order'
        )
        ->where('person_type_information.company_id', $personTypeInformation->company_id)
        ->where('person_id', $personTypeInformation->person_id)
        ->where('person_type_information.type_information_id', $personTypeInformation->type_information_id)
        ->where('consecutive', $personTypeInformation->consecutive)
        ->join('detail_type_information', 'person_type_information.detail_type_information_id', '=', 'detail_type_information.id')
        ->orderBy('detail_type_information.order', 'ASC')
        ->get();
    
     
        return view('personTypeInformation.editFilter', 
        [
            'companies'=>$companies,
            'detailTypeInformations'=>$detailTypeInformation,
            'typeInformations'=>$typeInformations,
            'personTypeInformations'=>$personTypeInformationOrden,
            'people'=> $people
        ]);
    }

    public function update(PersonTypeInformationRequest $request, PersonTypeInformation $personTypeInformation):RedirectResponse
    {
        $personTypeInformation->update($request->all());
        return redirect()->route('personTypeInformation.index')->with('success', 'Person Type Information updated');
    }

    public function destroy(PersonTypeInformation $personTypeInformation): RedirectResponse
    {
        $personTypeInformation->delete();
        return redirect()->route('personTypeInformation.index')->with('danger', 'Person Type Information deleted');
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->input('personTypeInformations'); // Array de datos enviados
   
        foreach ($data as $id => $fields) {
            $personTypeInformation = PersonTypeInformation::find($id);
    
            if ($personTypeInformation) {
                $personTypeInformation->update($fields); // Actualizar cada registro con los campos enviados
            }
        }
   
        return redirect()->route('personTypeInformation.index')->with('success', 'Information updated successfully!');
    }
    

}