<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motor extends Model
{
    use HasFactory;

    protected $collection = "motors";
    protected $fillable = ["mesin", "tipe_suspensi", "tipe_transmisi", "kendaraan"];
}
