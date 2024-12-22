@extends('layouts.app')

@section('title', 'Agregar Transacción')

@section('content')
<h1 class="mb-4">Agregar Transacción</h1>
<form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <select class="form-control" id="type" name="type" required>
            <option value="income">Ingreso</option>
            <option value="expense">Gasto</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Categoría</label>
        <select class="form-control" id="category_id" name="category_id" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Monto</label>
        <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
@endsection

