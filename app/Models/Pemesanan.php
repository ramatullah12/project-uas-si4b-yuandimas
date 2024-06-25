<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'rute_id',
        'transportasi_id',
        'category_id',
        'tanggal_pemesanan',
        'jumlah_tiket',
        'total_harga',
    ];
    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'transportasi_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
