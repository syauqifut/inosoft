<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory;

    protected $collection = "kendaraans";
    protected $fillable = ["tahun_keluaran", "warna", "harga"];
}
