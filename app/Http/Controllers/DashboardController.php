<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $transportasipemesenan = DB::select("SELECT transportasis.jenis, COUNT(*) as jumlah_tiket 
        FROM pemesanans
        JOIN transportasis ON pemesanans.transportasi_id = transportasis.id
        GROUP BY transportasis.jenis;");
        return view('dashboard')->with('transportasipemesenan', $transportasipemesenan);    }
}
