<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rute = Rute::with('transportasi')->get();
        return view('rute.index', compact('rute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transportasi = Transportasi::all();
        return view('rute.create', compact('transportasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create',Rute::class)){
            abort(403);
        }
        $validated = $request->validate([
            'start' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'transportasi_id' => 'required|exists:transportasis,id',
        ]);

        Rute::create($validated);

        return redirect()->route('rute.index')->with('success', 'Rute berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rute $rute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rute = Rute::findOrFail($id);
        $transportasi = Transportasi::all();
        return view('rute.edit', compact('rute', 'transportasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'start' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'transportasi_id' => 'required|exists:transportasis,id',
        ]);

        $rute = Rute::findOrFail($id);
        $rute->update($validated);

        return redirect()->route('rute.index')->with('success', 'Rute berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rute::findOrFail($id)->delete();

        session()->flash('success', 'Category berhasil di hapus.');
    
        return redirect()->route('rute.index');
    }
}
