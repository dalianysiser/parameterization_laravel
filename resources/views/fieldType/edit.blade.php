@extends('layouts.app')
@section('title')
    Field Type
@endsection

@section('content')

<main class="w-full flex-grow p-6">
    <h1 class="w-full text-3xl text-black pb-6"></h1>
    <a href="{{route('fieldType.index')}}">Back</a>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Edit Field Type
            </p>
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('fieldType.update', $fieldType->id)}}">
                @method('PUT')
                @csrf
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text" required="" placeholder="Name" aria-label="Name" value="{{old('name', $fieldType->name)}}">
                        @error('name')
                            <p style="color: red;">{{$message}}</p>
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