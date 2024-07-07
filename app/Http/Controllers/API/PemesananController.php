<?php

namespace App\Http\Controllers\API;

use App\Models\Pemesanan;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::all();
        if ($pemesanan->isEmpty()) {
            $response['message'] = 'Tidak ada Pemesanan yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'Pemesanan ditemukan.';
        $response['data'] = $pemesanan;
        return response()->json($response, Response::HTTP_OK);
        // atau
        // return response()->json($response, 200);
    }
    public function store(Request $request)
{
    $validate = $request->validate([
        'nama' => 'required|string|max:255',
        'rute_id' => 'required|exists:rutes,id',
        'transportasi_id' => 'required|exists:transportasis,id',
        'category_id' => 'required|exists:categories,id',
        'tanggal_pemesanan' => 'required|date',
        'jumlah_tiket' => 'required|integer|min:1',
        'total_harga' => 'required|numeric|min:0'
    ]);

    $pemesanan = Pemesanan::create($validate);
    if($pemesanan){
        $response['success'] = true;
        $response['message'] = 'pemesanan berhasil ditambahkan.';
        return response()->json($response, Response::HTTP_CREATED);
    }
}
public function update(Request $request, $id)
{
    $validate = $request->validate([
        'nama' => 'required|string|max:255',
        'rute_id' => 'required|exists:rutes,id',
        'transportasi_id' => 'required|exists:transportasis,id',
        'category_id' => 'required|exists:categories,id',
        'tanggal_pemesanan' => 'required|date',
        'jumlah_tiket' => 'required|integer|min:1',
        'total_harga' => 'required|numeric|min:0'
    ]);

    Pemesanan::where('id', $id)->update($validate);
    $response['success'] = true;
    $response['message'] = 'Pemesanan berhasil diperbarui.';
    return response()->json($response, Response::HTTP_OK);
}
public function destroy($id)
{
    $pemesanan = Pemesanan::where('id', $id);
    if(count($pemesanan->get())){
        $pemesanan->delete();
        $response['success'] = true;
        $response['message'] = 'Pemesanan berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    } else {
        $response['success'] = false;
        $response['message'] = 'Pemesanan tidak ditemukan.';
        return response()->json($response, Response::HTTP_NOT_FOUND);
    } 
}


}
