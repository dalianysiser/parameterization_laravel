@extends('layouts.app')
@section('title')
Person Type Information
@endsection
@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">New Person Type Information Filter</h1>
        <a href="{{route('personTypeInformation.index')}}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full my-6">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('personTypeInformation.storeFilter')}}">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Person -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="personName">Person</label>
                            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="personName" name="personName" value="{{$person->name}}" readonly type="text" required placeholder="Name" aria-label="Name">
                            <input type="hidden" name="person" value="{{$person->id}}">
                            @error('person')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Type Information -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="typeinformationName">Type information</label>
                            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="typeinformationName" name="typeinformationName" value="{{$typeInformation->codTypeInformation}}|{{$typeInformation->typeInformation}}" readonly type="text" required aria-label="Type Information">
                            <input type="hidden" name="typeinformation" value="{{$typeInformation->id}}">
                            @error('typeinformation')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                            <input type="hidden" name="consecutive" value="{{$consecutive}}">
                        </div>

                        <!-- Dynamic Fields -->
                        @foreach ($detailTypeInformations as $detail)
                        <div class="mb-4">
                            @if ($detail->comesCombo == 0)
                                @if ($detail->fieldType->name == 'Varchar')
                                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" type="text" name="field_1_{{$detail->id}}" placeholder="Enter text">
                                @elseif ($detail->fieldType->name == 'Date')
                                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" type="date" name="field_2_{{$detail->id}}">
                                @elseif ($detail->fieldType->name == 'Int')
                                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" type="number" name="field_3_{{$detail->id}}" placeholder="Enter number">
                                @elseif ($detail->fieldType->name == 'Decimal')
                                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" type="number" step="0.01" name="field_4_{{$detail->id}}" placeholder="Enter decimal value">
                                @elseif ($detail->fieldType->name == 'Check')
                                    <div class="flex items-center">
                                        <input class="mr-2 leading-tight" type="checkbox" name="field_5_{{$detail->id}}" checked>
                                        <span class="text-gray-700">Check</span>
                                    </div>
                                @endif
                            @else
                                @if ($detail->fieldType->name == 'Varchar')
                                    <select class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" name="field_1_{{$detail->id}}" id="field_1_{{$detail->id}}">
                                        <option value="" selected>Select...</option>
                                        @foreach ($detail->typeComboInformation as $typeComboInformation)
                                            <option value="{{$typeComboInformation->id}}">{{$typeComboInformation->type}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        <button class="px-4 py-2 text-white font-bold tracking-wider bg-gray-900 hover:bg-gray-700 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
