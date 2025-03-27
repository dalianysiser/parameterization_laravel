@extends('layouts.app')
@section('title')
    Person
@endsection

@section('content')
<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">People</h1>
        <a href="{{route('person.create')}}" class="flex items-center text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            <i class="fas fa-plus-circle mr-2"></i>
            Create New Person
        </a>
    </div>
    <div class="w-full mt-6">
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Company</th>
                        <th class="w-1/6 text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($people as $person)
                    <tr>
                        <td class="text-left py-3 px-4">
                            {{$person->name}}
                        </td>
                        <td class="text-left py-3 px-4">
                            {{$person->company->name}}
                        </td>
                        <td class="text-center py-2 px-2">
                            <a title="Show" href="{{ route('person.show', $person->id) }}" class="text-black opacity-75 hover:opacity-100 mx-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Edit" href="{{ route('person.edit',$person->id) }}" class="text-black opacity-75 hover:opacity-100 mx-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('person.destroy', $person->id) }}" style="display:inline;" class="mx-2">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="text-red-500 opacity-75 hover:opacity-100" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-3 px-4">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection