<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mobil extends Model
{
    use HasFactory;

    protected $collection = "mobils";
    protected $fillable = ["mesin", "kapasitas_penumpang", "tipe", "kendaraan", "terjual"];
}
