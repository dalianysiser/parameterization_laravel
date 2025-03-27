@extends('layouts.app')
@section('title')
    Person Type Information
@endsection
@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black"></h1>
        <a href="{{route('personTypeInformation.index')}}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Edit Information
            </p>
            <div class="leading-loose">
            <form method="POST" action="{{ route('personTypeInformation.bulkUpdate') }}">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-1 gap-6">
                @foreach ($personTypeInformations as $personTypeInformation)
                    <div class="border rounded p-4">
                        <!-- Person -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="person_id_{{$personTypeInformation->id}}">Person</label>
                            <select name="personTypeInformations[{{$personTypeInformation->id}}][person_id]" id="person_id_{{$personTypeInformation->id}}" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($people as $person)
                                    <option value="{{$person->id}}" {{ old("personTypeInformations.{$personTypeInformation->id}.person_id", $personTypeInformation->person_id) == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Company -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600">Company</label>
                            <input type="hidden" name="personTypeInformations[{{$personTypeInformation->id}}][company_id]" value="{{$personTypeInformation->company_id}}">
                            <input type="text" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" value="{{$personTypeInformation->company->name}}" readonly>
                        </div>

                        <!-- Other Fields -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600">Consecutive</label>
                            <input type="text" name="personTypeInformations[{{$personTypeInformation->id}}][consecutive]" value="{{ old("personTypeInformations.{$personTypeInformation->id}.consecutive", $personTypeInformation->consecutive) }}" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                        </div>
                        
                        <!-- Example of Additional Field -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="field_1_{{$personTypeInformation->id}}">Field 1</label>
                            <input type="text" name="personTypeInformations[{{$personTypeInformation->id}}][field_1]" id="field_1_{{$personTypeInformation->id}}" value="{{ old("personTypeInformations.{$personTypeInformation->id}.field_1", $personTypeInformation->field_1) }}" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <button class="px-4 py-2 text-white font-bold tracking-wider bg-blue-500 hover:bg-blue-700 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out" type="submit">
                    Submit
                </button>
            </div>
        </form>

            </div>
        </div>
    </div>
</main>
@endsection

