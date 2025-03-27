@extends('layouts.app')
@section('title')
    Company
@endsection

@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">Edit Type Information</h1>
        <a href="{{route('typeInformation.index')}}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('typeInformation.update', $typeInformation->id)}}">
                @method('PUT')
                @csrf
                    <div class="mb-4">
                        <label class="block text-sm text-gray-600" for="codTypeInformation">Code</label>
                        <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="codTypeInformation" name="codTypeInformation" type="text" required placeholder="Code" aria-label="Code"
                            value="{{old('codTypeInformation', $typeInformation->codTypeInformation)}}">
                        @error('codTypeInformation')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600" for="typeInformation">Type Information</label>
                        <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="typeInformation" name="typeInformation" type="text" required placeholder="Type Information" aria-label="typeInformation"
                        value="{{old('typeInformation', $typeInformation->typeInformation)}}">
                        @error('typeInformation')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-600" for="company_id">Company</label>
                        <select name="company_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}" {{ (old('company_id') == $company->id || (isset($typeInformation) && $typeInformation->company_id == $company->id)) ? 'selected' : '' }}>{{$company->name}}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Aligning checkboxes in a single row -->
                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 mb-2">Options</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_singleRegistry" class="mr-2 leading-tight" {{ old('is_singleRegistry', $typeInformation->is_singleRegistry) ? 'checked' : '' }}>
                                <span class="text-gray-700">Single Registry</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" class="mr-2 leading-tight" {{ old('is_active', $typeInformation->is_active) ? 'checked' : '' }}>
                                <span class="text-gray-700">Active</span>
                            </label>
                        </div>
                        @error('is_singleRegistry')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @error('is_active')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
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