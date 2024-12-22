@extends('layouts.app')

@section('title', 'Agregar Categoría')

@section('content')
<h1 class="mb-4">Agregar Categoría</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
@endsection
