<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'name' => 'required',
            'singkatan' => 'required',
            'harga' => 'required'
        ]);

        Category::create($val);

        return redirect()->route('category.index')->with('success', 'Category berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'singkatan' => 'required|string|max:255',
            'hargac' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'category berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    Category::findOrFail($id)->delete();

    session()->flash('success', 'Category berhasil di hapus.');

    return redirect()->route('category.index');
    }
}
