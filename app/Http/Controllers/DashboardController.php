<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $transportasipemesanan = DB::select("SELECT transportasis.nama, COUNT(*) as jumblah 
            FROM pemesanans
            JOIN pemesanans on transportasis.pemesanan_id = pemesanan_id
            GROUP BY transportasis.nama ");
        return view('dashboard');
    }
}
