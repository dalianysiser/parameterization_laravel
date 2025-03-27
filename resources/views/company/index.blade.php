@extends('layouts.app')
@section('title')
Company
@endsection
@section('content')
<main class="w-full flex-grow p-6">
    <div class="flex justify-between items-center pb-6">
        <h1 class="text-3xl text-black">Companies</h1>
        <a href="{{route('company.create')}}" class="flex items-center text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
            <i class="fas fa-plus-circle mr-2"></i>
            Create New Company
        </a>
    </div>

    <!-- Formulario de Búsqueda -->
    <form method="GET" action="{{ route('company.index') }}" class="mb-6">
        <div class="flex items-center">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search for a company..."
                class="w-full p-2 border border-gray-300 rounded-lg"
            />
            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Search
            </button>
        </div>
    </form>

    <div class="w-full mt-6">
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/6 text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($companies as $company)
                    <tr>
                        <td class="text-left py-3 px-4">
                            {{ $company->name }}
                        </td>
                        <td class="text-center py-2 px-2">
                            <a title="Show" href="{{ route('company.show', $company->id) }}" class="text-black opacity-75 hover:opacity-100 mx-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Edit" href="{{ route('company.edit', $company->id) }}" class="text-black opacity-75 hover:opacity-100 mx-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('company.destroy', $company->id) }}" style="display:inline;" class="mx-2">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="text-red-500 opacity-75 hover:opacity-100" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-3 px-4">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $companies->links('pagination::tailwind') }}
        </div>
    </div>
</main>
@endsection
