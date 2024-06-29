<?php

namespace App\Http\Controllers\API;

use App\Models\Pemesanan;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

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
}
