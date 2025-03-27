@extends('layouts.app')
@section('title')
    Type Information
@endsection
@section('content')
<main class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Botón para volver -->
    <div class="mb-6">
        <a href="{{ route('typeInformation.index') }}" class="inline-block text-blue-500 hover:text-blue-700 font-bold">
            ← Back to Type Information
        </a>
    </div>

    <!-- Información Detallada -->
    <div class="space-y-4">
        <h1 class="text-2xl font-semibold text-gray-800">Type Information Details</h1>
        
        <!-- Código del Tipo de Información -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Code</h2>
            <p><strong>Code:</strong> {{$typeInformation->codTypeInformation}}</p>
        </div>

        <!-- Nombre del Tipo de Información -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Type Information Name</h2>
            <p><strong>Name:</strong> {{$typeInformation->typeInformation}}</p>
        </div>

        <!-- Detalles del Registro -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Registry Details</h2>
            <p><strong>Single Registry:</strong> {{$typeInformation->is_singleRegistry ? 'Yes' : 'No'}}</p>
            <p><strong>Is Active:</strong> {{$typeInformation->is_active ? 'Yes' : 'No'}}</p>
        </div>

        <!-- Información de la Compañía -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Company</h2>
            <p><strong>Company ID:</strong> {{$typeInformation->company->id}}</p>
        </div>
    </div>
</main>
@endsection
