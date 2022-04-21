<?php

namespace App\Repository\Mobil;

use App\Models\Kendaraan;
use App\Models\Mobil;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EloquentMobilRepository implements MobilRepository
{
    public function store(Request $request)
    {
        $mobil = Mobil::create($request->all());
        
        return $mobil;
    }

    public function index()
    {
        return Mobil::all();
        
    }

    public function show($id)
    {
        return Mobil::findOrFail($id);
        
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);
        
        $mobil->update($request->all());

        return $mobil;
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);
        
        $mobil->delete();
    }

    public function status($id){
        $mobil = Mobil::findOrFail($id);
        $mobilcheck = Mobil::where('_id', $id)->whereNotNull('terjual')->first();
        $date = Carbon::now()->toDateTimeString();
        if ($mobilcheck === null) {
            $update['terjual'] = $date;
        }else{
            $update['terjual'] = NULL;
        }
        $mobil->update($update);
        
        return $mobil;
    }

    public function sold(){
        return Mobil::whereNotNull('terjual')->get();
    }

    public function showDetailMobil($id){
        return Mobil::find($id);
    }

    public function showDetailMobilKendaraan($mobil){
        return Kendaraan::find($mobil->kendaraan);
    }
}
