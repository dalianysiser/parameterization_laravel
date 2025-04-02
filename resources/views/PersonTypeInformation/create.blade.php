@extends('layouts.app')
@section('title')
    Type Combo Information
@endsection

@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">New Person Type Information</h1>
        <a href="{{ route('personTypeInformation.index') }}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full my-6">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('personTypeInformation.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Selección de Persona -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="person_id">Person</label>
                            <select id="person" name="person" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($people as $person)
                                    <option value="{{ $person->id }}">{{ $person->name }}</option>
                                @endforeach
                            </select>
                            @error('person')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Selección de Compañía -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="company_id">Company</label>
                            <select id="company_id" name="company_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Selección de Tipo de Información -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="type_information_id">Type Information</label>
                            <select id="type_information_id" name="type_information_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                <option value="">Select Type Information</option>
                                @foreach ($typeInformations as $type_information)
                                    <option value="{{ $type_information->id }}">{{ $type_information->typeInformation }}</option>
                                @endforeach
                            </select>
                            @error('type_information_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contenedor Dinámico para Detalle Type Information -->
                    <div id="dynamic-fields-container" class="grid grid-cols-2 gap-6 mt-6">
                        <!-- Los campos se cargarán aquí dinámicamente -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
       
        $('#type_information_id').on('change', function () {
            const typeInformationId = $(this).val();

            if (typeInformationId) {
              
                $.ajax({
                    url: "{{ route('get.detail.type.information') }}",
                    type: "POST",
                    data: {
                        type_information_id: typeInformationId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                       
                        $('#dynamic-fields-container').empty();

                        data.forEach(function (detail) {
                            let fieldType = detail.field_type || 'text'; // Tipo de campo dinámico
                            let step = fieldType === 'number' && detail.step ? `step="${detail.step}"` : ''; // Atributo "step" para números
                            let options = '';

                            if (fieldType === 'select' && detail.options) {
                                options = detail.options.map(option => `<option value="${option.id}">${option.type}</option>`).join('');
                                $('#dynamic-fields-container').append(`
                                    <div class="mb-4">
                                        <label class="block text-sm text-gray-600" for="${detail.field_name}">${detail.detail}</label>
                                        <select id="${detail.field_name}" name="${detail.field_name}" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                            ${options}
                                        </select>
                                    </div>
                                `);
                            } else {
                                $('#dynamic-fields-container').append(`
                                    <div class="mb-4">
                                        <label class="block text-sm text-gray-600" for="${detail.field_name}">${detail.detail}</label>
                                        <input id="${detail.field_name}" name="${detail.field_name}" type="${fieldType}" ${step} class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" placeholder="${detail.detail}">
                                    </div>
                                `);
                            }
                        });
                    },
                    error: function () {
                        alert('Error loading detail type information.');
                    }
                });
            } else {
                // Limpiar campos dinámicos si no hay selección válida
                $('#dynamic-fields-container').empty();
            }
        });
    });
</script>

@endsection
