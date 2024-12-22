<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los parámetros de búsqueda y filtros
        $search = $request->input('search');
        $type = $request->input('type');
        $category = $request->input('category');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filtrar las transacciones
        $transactions = Transaction::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('description', 'like', "%{$search}%");
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('date', '<=', $endDate);
            })
            ->paginate(10);

        // Obtener las categorías para el filtro
        $categories = Category::all();

        return view('transactions.index', compact('transactions', 'search', 'type', 'category', 'startDate', 'endDate', 'categories'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // Create a new transaction
        $transaction = Transaction::create($request->all());

        // Respond with the new transaction
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show($id)
    {
        // Find the transaction by ID
        $transaction = Transaction::with('category')->findOrFail($id);

        // Respond with the transaction
        return view('transactions.show', compact('transaction'));
    }

    public function update(Request $request, $id){
        // Validate the request
        $request->validate([
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // Find the transaction by ID
        $transaction = Transaction::findOrFail($id);

        // Update the transaction with the provided data
        $transaction->update($request->all());

        // Respond with the updated transaction
        redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id){
        // Find the transaction by ID
        $transaction = Transaction::findOrFail($id);

        // Delete the transaction
        $transaction->delete();

        // Respond with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    public function create(){

        $categories = Category::all();

        return view('transactions.create', compact('categories'));
    }
}
