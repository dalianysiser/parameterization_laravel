@extends('layouts.app')
@section('title')
    Welcome
@endsection
@push('css')
    <style>
        body{
            background-color: #f3f3f3
        }
    </style>
@endpush
@section('content')
    <div class="max-w-4xl mx-auto px-4">
        {{-- <h1>holaaaa </h1>
        <x-alert2 type="success" class="mb-5">
            <x-slot name="title">Tipo:</x-slot>
            contenido de la alerta
        </x-alert2> --}}
        {{-- @if(true)
            <p>parrafo</p>
        @endif
        <ul>
        @foreach ($collection as $item)
            <li>
                <a href="/xx/{{$var->id}}"></a>
                <a href="{{route('home.index', $id)}}"></a>
            </li>
        @endforeach
        </ul> --}}
    </div>
@endsection

{{-- en un formulario poner @csrf paratoken --}}
