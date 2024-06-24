<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pemesanan;
use App\Models\Rute;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $pemesanan = Pemesanan::with(['rute', 'transportasi', 'category'])->get();
        return view('pemesanan.index', compact('pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rute = Rute::all();
        $transportasi = Transportasi::all();
        $category = Category::all();
        return view('pemesanan.create', compact('rute', 'transportasi', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'rute_id' => 'required|exists:rutes,id',
            'transportasi_id' => 'required|exists:transportasis,id',
            'category_id' => 'required|exists:categories,id',
            'tanggal_pemesanan' => 'required|date',
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $rute = Rute::findOrFail($request->rute_id);
        $expectedTotalHarga = $rute->harga * $request->jumlah_tiket;

        if ($request->total_harga != $expectedTotalHarga) {
            return back()->withErrors(['total_harga' => 'Total harga tidak valid.'])->withInput();
        }

        Pemesanan::create($request->all());

        return redirect()->route('pemesanan.index')
                         ->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $rute = Rute::all();
        $transportasi = Transportasi::all();
        $category = Category::all();
        return view('pemesanan.edit', compact('pemesanan', 'rute', 'transportasi', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'rute_id' => 'required|exists:rutes,id',
            'transportasi_id' => 'required|exists:transportasis,id',
            'category_id' => 'required|exists:categories,id',
            'tanggal_pemesanan' => 'required|date',
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);
    
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->fill($validated);
        $pemesanan->save();
    
        return redirect()->route('pemesanan.index')
                         ->with('success', 'Pemesanan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus');
    }
}
