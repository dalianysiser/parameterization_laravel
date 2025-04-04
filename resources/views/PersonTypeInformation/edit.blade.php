@extends('layouts.app')
@section('title')
Person Type Information
@endsection
@section('content')

<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">Edit Person Type Information</h1>
        <a href="{{route('personTypeInformation.index')}}" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            Back
        </a>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full my-6">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{route('personTypeInformation.update', $personTypeInformation->id)}}">
                    @method('PUT')
                    @csrf
                    <!-- Two-column layout -->
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Column 1 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="person_id">Person</label>
                            <select name="person_id" id="person_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($people as $person)
                                <option value="{{$person->id}}" {{ old('person_id', $personTypeInformation->person_id) == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                            @error('person_id')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="company_id">Company</label>
                            <select name="company_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($companies as $company)
                                <option value="{{$company->id}}" {{ old('company_id', $personTypeInformation->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Column 2 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="type_information_id">Type Information</label>
                            <select id="type_information_id" name="type_information_id" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                @foreach ($typeInformations as $type_information)
                                <option value="{{$type_information->id}}" {{ old('type_information_id', $personTypeInformation->type_information_id) == $type_information->id ? 'selected' : '' }}>{{ $type_information->typeInformation }}</option>
                                @endforeach
                            </select>
                            @error('type_information_id')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Column 1 -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="consecutive">Consecutive</label>
                            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" id="consecutive" name="consecutive" type="text" readonly value="{{old('consecutive', $personTypeInformation->consecutive)}}" required placeholder="Consecutive" aria-label="Consecutive">
                            @error('consecutive')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Contenedor Dinámico para Detalle Type Information -->
                        <div id="dynamic-fields-container" class="grid grid-cols-2 gap-6 mt-6">
                            <!-- Los campos se cargarán aquí dinámicamente -->
                        </div>

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
    $(document).ready(function() {
        function loadDynamicFields(typeInformationId) {
            if (typeInformationId) {
                // Realizar la solicitud AJAX
                
                $.ajax({
                    url: "{{ route('get.detail.type.information') }}",
                    type: "POST",
                    data: {
                        type_information_id: typeInformationId,
                        person_id:  $('#person_id').val(),
                        consecutive: $('#consecutive').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // Limpiar el contenedor de campos dinámicos
                        $('#dynamic-fields-container').empty();

                        // Crear los campos dinámicos según los datos recibidos
                        data.forEach(function(detail) {
                            let fieldType = detail.field_type || 'text'; // Tipo de campo dinámico
                            let step = fieldType === 'number' && detail.step ? `step="${detail.step}"` : ''; // Atributo para números
                            let options = '';
                            
                            if (fieldType === 'select' && detail.options) {
                                // Generar opciones para campos tipo select
                                options = detail.options.map(option => {
                                    const selected = option.id == detail.value ? 'selected' : ''; // Verificar si el valor guardado coincide
                                    
                                    return `<option value="${option.id}" ${selected}>${option.type}</option>`;
                                }).join('');

                                $('#dynamic-fields-container').append(`
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-600" for="${detail.field_name}">${detail.detail}</label>
                                    <select id="${detail.field_name}" name="${detail.field_name}" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white">
                                        ${options}
                                    </select>
                                </div>
                            `);
                            } else {
                                // Generar campos de entrada para otros tipos
                                $('#dynamic-fields-container').append(`
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-600" for="${detail.field_name}">${detail.detail}</label>
                                    <input id="${detail.field_name}" name="${detail.field_name}" type="${fieldType}" value="${detail.value}" ${step} class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-none focus:bg-white" placeholder="${detail.detail}">
                                </div>
                            `);
                            }
                        });
                    },
                    error: function() {
                        alert('Error loading detail type information.');
                    }
                });
            } else {
                // Si no hay selección válida, limpiar el contenedor dinámico
                $('#dynamic-fields-container').empty();
            }
        }

        // Llamar automáticamente al cargar la página
        const typeInformationId = $('#type_information_id').val();
        if (typeInformationId) {
            loadDynamicFields(typeInformationId); // Cargar los campos con los datos existentes
        }

        // Evento onchange para actualizar los datos dinámicamente
        $('#type_information_id').on('change', function() {
            const typeInformationId = $(this).val();
            loadDynamicFields(typeInformationId);
        });
    });
</script>
@endsection