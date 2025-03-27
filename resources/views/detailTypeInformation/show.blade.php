@extends('layouts.app')
@section('title')
    Type Information
@endsection
@section('content')
<main class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Botón para volver -->
    <div class="mb-6">
        <a href="{{ route('detailTypeInformation.index') }}" class="inline-block text-blue-500 hover:text-blue-700 font-bold">
            ← Back to Detail Type Information
        </a>
    </div>

    <!-- Información Detallada -->
    <div class="space-y-4">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Type Information</h1>
        
        <!-- Información del Tipo -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Type Information</h2>
            <p><strong>Type Name:</strong> {{$detailTypeInformation->typeInformation->name}}</p>
        </div>

        <!-- Información de la Compañía -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Company</h2>
            <p><strong>Company Name:</strong> {{$detailTypeInformation->company->name}}</p>
        </div>

        <!-- Detalles Específicos -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="font-bold text-lg text-gray-700">Details</h2>
            <p><strong>Detail:</strong> {{$detailTypeInformation->detail}}</p>
            <p><strong>Field Type:</strong> {{$detailTypeInformation->fieldType->name}}</p>
            <p><strong>Comes Combo:</strong> {{$detailTypeInformation->comesCombo ? 'Yes' : 'No'}}</p>
            <p><strong>Order:</strong> {{$detailTypeInformation->order}}</p>
            <p><strong>Is Active:</strong> {{$detailTypeInformation->is_active ? 'Yes' : 'No'}}</p>
        </div>
    </div>
</main>
@endsection
