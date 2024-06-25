<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Rute;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Contoh penggunaan view() dalam controller
    public function index()
    {
        $transportasi = Transportasi::all();
        return view('transportasi.index', compact('transportasi'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transportasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create',Transportasi::class)){
            abort(403);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);

        Transportasi::create($validated);

        return redirect()->route('transportasi.index')->with('success', 'Transportasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transportasi $transportasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        return view('transportasi.edit', compact('transportasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);

        $transportasi = Transportasi::findOrFail($id);
        $transportasi->update($validated);

        return redirect()->route('transportasi.index')->with('success', 'Transportasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    Transportasi::findOrFail($id)->delete();

    session()->flash('success', 'Transportasi berhasil di hapus.');

    return redirect()->route('category.index');
    }
}
