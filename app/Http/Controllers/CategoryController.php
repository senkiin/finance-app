<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category')); // Renderiza la vista
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }

    public function create(){

        $categories = Category::all();

        return view('categories.create', compact('categories'));
    }

}
