<?php

namespace App\Repository\Motor;

use App\Models\Kendaraan;
use App\Models\Motor;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EloquentMotorRepository implements MotorRepository
{
    public function store(Request $request)
    {
        $motor = Motor::create($request->all());
        
        return $motor;
    }

    public function index()
    {
        return Motor::all();
        
    }

    public function show($id)
    {
        return Motor::findOrFail($id);
        
    }

    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);
        
        $motor->update($request->all());

        return $motor;
    }

    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        
        $motor->delete();
    }

    public function status($id){
        $motor = Motor::findOrFail($id);
        $motorcheck = Motor::where('_id', $id)->whereNotNull('terjual')->first();
        $date = Carbon::now()->toDateTimeString();
        if ($motorcheck === null) {
            $update['terjual'] = $date;
        }else{
            $update['terjual'] = NULL;
        }
        $motor->update($update);
        
        return $motor;
    }

    public function sold(){
        return Motor::whereNotNull('terjual')->get();
    }

    public function showDetailMotor($id){
        return Motor::find($id);
    }

    public function showDetailMotorKendaraan($motor){
        return Kendaraan::find($motor->kendaraan);
    }
}
