@extends('layouts.app')
@section('title')
    Type Information
@endsection
@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">New Detail Type Information</h1>
        <a href="{{route('company.index')}}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full my-6">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('detailTypeInformation.store')}}">
                @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Left column -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="type_information_id">Type Information</label>
                            <select name="type_information_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($typeInformations as $type_information)
                                    <option value="{{$type_information->id}}" {{ old('type_information_id') == $type_information->id ? 'selected' : '' }}>
                                        {{$type_information->typeInformation}}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_information_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="company_id">Company</label>
                            <select name="company_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($companies as $company)
                                    <option value="{{$company->id}}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{$company->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Right column -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="detail">Detail</label>
                            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="detail" name="detail" type="text" required placeholder="Detail" aria-label="Detail" value="{{ old('detail') }}">
                            @error('detail')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="field_type_id">Field Type</label>
                            <select name="field_type_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($fieldTypes as $field_type)
                                    <option value="{{$field_type->id}}" {{ old('field_type_id') == $field_type->id ? 'selected' : '' }}>
                                        {{$field_type->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('field_type_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- First column: Checkboxes -->
                        <div class="flex items-center space-x-6">
                            <div class="flex items-center">
                                <input type="checkbox" name="comesCombo" {{ old('comesCombo') ? 'checked' : '' }} class="mr-2 leading-tight">
                                <label class="text-gray-700">Comes from Combo</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }} class="mr-2 leading-tight">
                                <label class="text-gray-700">Active</label>
                            </div>
                        </div>

                        <!-- Second column: Order -->
                        <div>
                            <label class="block text-sm text-gray-600" for="order">Order</label>
                            <input type="number" name="order" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" value="{{ old('order') }}" placeholder="Order">
                            @error('order')
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
