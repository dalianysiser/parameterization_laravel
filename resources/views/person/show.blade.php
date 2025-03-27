@extends('layouts.app')
@section('title')
    Field Type
@endsection
@section('content')
<main class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
  
    <div class="mb-6">
        <a href="{{ route('company.index') }}" class="inline-block text-blue-500 hover:text-blue-700 font-bold">
            ← Back to Companies
        </a>
    </div>

    <div class="bg-gray-100 p-4 rounded-md">
        <h1 class="text-2xl font-semibold text-gray-800">{{$company->name}}</h1>
    </div>
</main>
@endsection
