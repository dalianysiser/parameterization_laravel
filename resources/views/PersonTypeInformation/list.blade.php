@extends('layouts.app')
@section('title')
    Person Type Information
@endsection

@section('content')
<main class="w-full flex-grow p-6 bg-gray-100">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-4xl font-bold text-blue-600">Person Type Information</h1>
    </div>

    <div class="flex justify-between items-center pb-6">
        <form method="POST" action="{{ route('get.list.data') }}" class="mb-6 bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl">
            @csrf
            <div class="flex items-center justify-between">
                <div class="w-full mr-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="person_id">Select a Person</label>
                    <select name="data" class="w-full px-5 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        @foreach ($people as $person)
                            <option value="{{ $person->id }}">{{ $person->name }}</option>
                        @endforeach
                    </select>
                    @error('data')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="ml-auto bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out">
                    Search
                </button>
            </div>
        </form>
    </div>

    @if (isset($groupedInformation) && $groupedInformation->count() > 0)
        <!-- Mostrar el nombre de la persona y la compañía una sola vez -->
        <div class="w-full bg-white shadow-lg rounded-lg p-6 mb-6">
            <div class="flex flex-wrap items-center justify-between border-b pb-4">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <h2 class="text-xl font-semibold text-gray-700">Person</h2>
                    <p class="text-lg text-gray-600">{{ $groupedInformation->first()->first()->person->name }}</p>
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-gray-700">Company</h2>
                    <p class="text-lg text-gray-600">{{ $groupedInformation->first()->first()->company->name }}</p>
                </div>
            </div>
        </div>

        <!-- Mostrar detalles agrupados en tarjetas -->
        <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2">
            @foreach ($groupedInformation as $group)
                <div class="bg-gray-50 p-4 rounded-lg shadow-md border border-gray-300">
                    <h3 class="text-lg font-medium text-blue-600 mb-2">Consecutive: {{ $group->first()->consecutive }}</h3>
                    <p class="text-gray-600 mb-4"><strong>Type Information:</strong> {{ $group->first()->typeInformation->typeInformation }}</p>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Details:</h3>
                    @foreach ($group as $type)
                        <p class="text-gray-600"><strong>Detail Order:</strong> {{ $type->detail_order }}</p>
                        <p class="text-gray-600"><strong>{{ $type->detailTypeInformation->detail }}:</strong>
                        @if ($type->field_1)
                            @if( $type->detailTypeInformation->comesCombo  == 1)
                                <strong>{{ $type->type_combo_information_type }}</strong>
                                @else
                                    <strong>{{ $type->field_1 }}</strong>
                            @endif    
                        @endif
                        @if ($type->field_2)
                            <strong>{{ $type->field_2 }}</strong> 
                        @endif
                        @if ($type->field_3)
                           <strong>{{ $type->field_3 }}</strong> 
                        @endif
                        @if ($type->field_4)
                           <strong>{{ $type->field_4 }}</strong> 
                        @endif
                        @if ($type->field_5)
                            <strong>{{ $type->field_5 }}</strong> 
                        @endif
                    @endforeach
                    <div class="flex gap-4 mt-4">
                        
                        <a href="{{ route('personTypeInformation.edit', $type->id) }}" class="text-green-600 hover:text-green-800 font-medium">Edit</a>
                        <form method="POST" action="{{ route('personTypeInformation.destroy', $type->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-700 text-lg mt-6">No information found for the selected person.</p>
    @endif
</main>
@endsection
