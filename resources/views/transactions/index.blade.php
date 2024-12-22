@extends('layouts.app')

@section('title', 'Transacciones')

@section('content')
<h1 class="mb-4">Transacciones</h1>

<!-- Barra de búsqueda y filtros -->
<form action="{{ route('transactions.index') }}" method="GET" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Buscar descripción..." value="{{ $search ?? '' }}">
        </div>
        <div class="col-md-2">
            <select name="type" class="form-control">
                <option value="">Todos</option>
                <option value="income" {{ $type === 'income' ? 'selected' : '' }}>Ingreso</option>
                <option value="expense" {{ $type === 'expense' ? 'selected' : '' }}>Gasto</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="category" class="form-control">
                <option value="">Todas las categorías</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
        </div>
        <div class="col-md-2">
            <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary" type="submit">Filtrar</button>
        </div>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Categoría</th>
            <th>Monto</th>
            <th>Descripción</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ ucfirst($transaction->type) }}</td>
            <td>{{ $transaction->category->name }}</td>
            <td>${{ number_format($transaction->amount, 2) }}</td>
            <td>{{ $transaction->description }}</td>
            <td>{{ $transaction->date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Controles de paginación -->
<div class="d-flex justify-content-center">
    {{ $transactions->links() }}
</div>
@endsection
