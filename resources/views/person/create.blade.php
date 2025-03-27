@extends('layouts.app')
@section('title')
Person
@endsection

@section('content')

<main class="w-full flex-grow p-6">
    <h1 class="w-full text-3xl text-black pb-6"></h1>
    <a href="{{route('person.index')}}">Back</a>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> New Person
            </p>
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('person.store')}}">
                    @csrf
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text" required="" placeholder="Name" aria-label="Name">
                        @error('name')
                        <p style="color: red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="">
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
                    <div class="mt-6">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection