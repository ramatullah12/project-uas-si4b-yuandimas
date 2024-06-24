<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;
    protected $fillable = ['start', 'tujuan', 'harga', 'transportasi_id'];

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class);
    }
}
