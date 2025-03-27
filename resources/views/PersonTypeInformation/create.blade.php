@extends('layouts.app')
@section('title')
    Type Combo Information
@endsection

@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">New Person Type Information</h1>
        <a href="{{route('personTypeInformation.index')}}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full my-6">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('personTypeInformation.store')}}">
                @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Column 1 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="person_id">Person</label>
                            <select name="person_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($people as $person)            
                                    <option value="{{$person->id}}">{{$person->name}}</option>
                                @endforeach
                            </select>
                            @error('person_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="company_id">Company</label>
                            <select name="company_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($companies as $company)            
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Column 2 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="type_information_id">Type Information</label>
                            <select name="type_information_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($typeInformations as $type_information)            
                                    <option value="{{$type_information->id}}">{{$type_information->typeInformation}}</option>
                                @endforeach
                            </select>
                            @error('type_information_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="detail_type_information_id">Detail Type Information</label>
                            <select name="detail_type_information_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($detailTypeInformations as $detail)            
                                    <option value="{{$detail->id}}">{{$detail->detail}}</option>
                                @endforeach
                            </select>
                            @error('detail_type_information_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Column 1 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="consecutive">Consecutive</label>
                            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="consecutive" name="consecutive" type="text" value="{{old('consecutive')}}" required placeholder="Consecutive" aria-label="Consecutive">
                            @error('consecutive')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Column 2 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="field_1">Field 1</label>
                            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="field_1" name="field_1" type="text" required placeholder="Field 1" aria-label="Field 1">
                            @error('field_1')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
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
