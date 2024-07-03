<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transportasi;
use Illuminate\Http\Request;

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
        $response['message'] = 'Rute ditemukan.';
        $response['data'] = $transportasi;
        return response()->json($response, Response::HTTP_OK);
        // atau
        // return response()->json($response, 200);
    }
    public function store(Request $request)
{
    $validate = $request->validate([
        'name' => 'required',
            'singkatan' => 'required',
            'harga' => 'required'
    ]);

    $transportasi = Transportasi::create($validate);
    if($transportasi){
        $response['success'] = true;
        $response['message'] = 'transportasi berhasil ditambahkan.';
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
        $response['message'] = 'Rute berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    } else {
        $response['success'] = false;
        $response['message'] = 'Rute tidak ditemukan.';
        return response()->json($response, Response::HTTP_NOT_FOUND);
    } 
}
public function register(Request $request)
{
    $validate = $request->validate([
        'start' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'transportasi_id' => 'required|exists:transportasis,id',
    ]);

    $validate['password'] = bcrypt($request->password);

    $user = User::create($validate);
    $success['token'] = $user->createToken('MDPApp')->plainTextToken;
    $success['name'] = $user->name;

    return response()->json($success, Response::HTTP_CREATED);
}
public function login(Request $request)
{
    if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        $user = Auth::user();
        $success['token'] = $user->createToken('MDPApp')->plainTextToken;
        $success['name'] = $user->name;
        return response()->json($success, 201);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
}
