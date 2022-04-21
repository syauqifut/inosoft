<?php

namespace App\Repository\Kendaraan;

use App\Models\Kendaraan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EloquentKendaraanRepository implements KendaraanRepository
{
    public function store(Request $request)
    {
        $kendaraan = Kendaraan::create($request->all());
        
        return $kendaraan;
    }

    public function index()
    {
        return Kendaraan::all();
        
    }

    public function show($id)
    {
        return Kendaraan::findOrFail($id);
        
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        
        $kendaraan->update($request->all());

        return $kendaraan;
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        
        $kendaraan->delete();
    }
}

?>