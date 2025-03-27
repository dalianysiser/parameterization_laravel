@extends('layouts.app')
@section('title')
    Type Information
@endsection
@section('content')
<main class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Botón para volver -->
    <div class="mb-6">
        <a href="{{ route('typeComboInformation.index') }}" class="inline-block text-blue-500 hover:text-blue-700 font-bold">
            ← Back to Type Combo Information
        </a>
    </div>

    <!-- Información Detallada -->
    <div class="space-y-4">
        <h1 class="text-2xl font-semibold text-gray-800">Type Combo Information</h1>
        
        <!-- Información de la Compañía -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Company</h2>
            <p><strong>Name:</strong> {{$typeComboInformation->company->name}}</p>
        </div>

        <!-- Información del Tipo -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Type Information</h2>
            <p><strong>Type Name:</strong> {{$typeComboInformation->typeInformation->name}}</p>
            <p><strong>Type:</strong> {{$typeComboInformation->type}}</p>
            <p><strong>Code:</strong> {{$typeComboInformation->code}}</p>
        </div>

        <!-- Detalles y Estado -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Details</h2>
            <p><strong>Detail:</strong> {{$typeComboInformation->detailTypeInformation->detail}}</p>
            <p><strong>Is Active:</strong> {{$typeComboInformation->is_active ? 'Yes' : 'No'}}</p>
        </div>
    </div>
</main>
@endsection
