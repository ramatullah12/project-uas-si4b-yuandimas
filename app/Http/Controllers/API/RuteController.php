<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Rute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuteController extends Controller
{
    public function index()
    {
        $rute = Rute::all();
        if ($rute->isEmpty()) {
            $response['message'] = 'Tidak ada Rute yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'Rute ditemukan.';
        $response['data'] = $rute;
        return response()->json($response, Response::HTTP_OK);
        // atau
        // return response()->json($response, 200);
    }
    public function store(Request $request)
{
    $validate = $request->validate([
        'start' => 'required|string|max:255',
        'tujuan' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'transportasi_id' => 'required|exists:transportasis,id',
    ]);

    $rute = Rute::create($validate);
    if($rute){
        $response['success'] = true;
        $response['message'] = 'Rute berhasil ditambahkan.';
        return response()->json($response, Response::HTTP_CREATED);
    }
}
public function update(Request $request, $id)
{
    $validate = $request->validate([
        'start' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'transportasi_id' => 'required|exists:transportasis,id',
    ]);

    Rute::where('id', $id)->update($validate);
    $response['success'] = true;
    $response['message'] = 'Pemesanan berhasil diperbarui.';
    return response()->json($response, Response::HTTP_OK);
}
public function destroy($id)
{
    $rute = Rute::where('id', $id);
    if(count($rute->get())){
        $rute->delete();
        $response['success'] = true;
        $response['message'] = 'Rute berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    } else {
        $response['success'] = false;
        $response['message'] = 'Rute tidak ditemukan.';
        return response()->json($response, Response::HTTP_NOT_FOUND);
    } 
}

}
