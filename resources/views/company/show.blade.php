@extends('layouts.app')
@section('title')
Field Type
@endsection
@section('content')
<main class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Encabezado principal -->
    <h1 class="text-2xl font-semibold text-gray-800 pb-6">Company Details</h1>

    <!-- Botón para volver -->
    <div class="mb-6">
        <a href="{{ route('company.index') }}" class="inline-block text-blue-500 hover:text-blue-700 font-bold">
            ← Back to Company List
        </a>
    </div>

    <!-- Tabla de detalles -->
    <div class="bg-gray-100 p-4 rounded-md">
        <table class="text-left w-full border-collapse">
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-gray-700 border-b border-gray-300">
                        Name
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6 border-b border-gray-300">
                        {{$company->name}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
@endsection
