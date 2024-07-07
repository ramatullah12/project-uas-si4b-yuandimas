<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transportasi;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaportasiController extends Controller
{
    public function index()
    {
        $transportasi = Transportasi::all();
        if ($transportasi->isEmpty()) {
            $response['message'] = 'Tidak ada transportasi yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'Transportasi ditemukan.';
        $response['data'] = $transportasi;
        return response()->json($response, Response::HTTP_OK);
        // atau
        // return response()->json($response, 200);
    }
    public function store(Request $request)
{
    $validate = $request->validate([
        'nama' => 'required|string|max:255',
        'jenis' => 'required|string|max:255',
    ]);

    $transportasi = Transportasi::create($validate);
    if($transportasi){
        $response['success'] = true;
        $response['message'] = 'Fakultas berhasil ditambahkan.';
        return response()->json($response, Response::HTTP_CREATED);
    }
}
public function update(Request $request, $id)
{
    $validate = $request->validate([
        'nama' => 'required|string|max:255',
        'jenis' => 'required|string|max:255',
    ]);

    Transportasi::where('id', $id)->update($validate);
    $response['success'] = true;
    $response['message'] = 'transportasi berhasil diperbarui.';
    return response()->json($response, Response::HTTP_OK);
}
public function destroy($id)
{
    $transportasi = Transportasi::where('id', $id);
    if(count($transportasi->get())){
        $transportasi->delete();
        $response['success'] = true;
        $response['message'] = 'transportasi berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    } else {
        $response['success'] = false;
        $response['message'] = 'transportasi tidak ditemukan.';
        return response()->json($response, Response::HTTP_NOT_FOUND);
    } 
}

}
