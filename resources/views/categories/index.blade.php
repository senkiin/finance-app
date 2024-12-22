@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<h1>Categorías</h1>
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
