@extends('layouts.app')
@section('title')
    Person Type Information
@endsection
@section('content')
<main class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="mb-6">
        <a href="{{ route('personTypeInformation.index') }}" class="inline-block text-blue-500 hover:text-blue-700 font-bold">
            ← Back to List
        </a>
    </div>

    <div class="space-y-4">
        <h1 class="text-2xl font-semibold text-gray-800">Person Type Information</h1>
        
        
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Person Details</h2>
            <p><strong>Name:</strong> {{$personTypeInformation->person->name}}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Company</h2>
            <p><strong>Name:</strong> {{$personTypeInformation->company->name}}</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Details</h2>
            <p><strong>Type Information:</strong> {{$personTypeInformation->typeInformation->name}}</p>
            <p><strong>Detail:</strong> {{$personTypeInformation->detailTypeInformation->detail}}</p>
            <p><strong>Consecutive:</strong> {{$personTypeInformation->consecutive}}</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Additional Fields</h2>
            <p><strong>Field 1:</strong> {{$personTypeInformation->field_1}}</p>
            <p><strong>Field 2:</strong> {{$personTypeInformation->field_2}}</p>
            <p><strong>Field 3:</strong> {{$personTypeInformation->field_3}}</p>
            <p><strong>Field 4:</strong> {{$personTypeInformation->field_4}}</p>
            <p><strong>Field 5:</strong> {{$personTypeInformation->field_5}}</p>
        </div>
    </div>
</main>
@endsection
