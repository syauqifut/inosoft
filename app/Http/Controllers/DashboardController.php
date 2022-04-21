<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Mobil;
use App\Models\Motor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function stok()
    {
        $mobil = Mobil::all();
        $motor = Motor::all();
        $jumlahmobil = count($mobil);
        $jumlahmobilsold = count($mobil->whereNotNull('terjual'));
        $jumlahmobilnotsold = count($mobil->whereNull('terjual'));
        
        $jumlahmotor = count($motor);
        $jumlahmotorsold = count($motor->whereNotNull('terjual'));
        $jumlahmotornotsold = count($motor->whereNull('terjual'));
        
        $data = [
            'jumlahmobil' => $jumlahmobil,
            'jumlahmobilsold' => $jumlahmobilsold,
            'jumlahmobilnotsold' => $jumlahmobilnotsold,

            'jumlahmotor' => $jumlahmotor,
            'jumlahmotorsold' => $jumlahmotorsold,
            'jumlahmotornotsold' => $jumlahmotornotsold,

            'jumlahall' => $jumlahmobil + $jumlahmotor,
            'jumlahsoldall' => $jumlahmobilsold + $jumlahmotorsold,
            'jumlahnotsoldall' => $jumlahmobilnotsold + $jumlahmotornotsold,
        ];
        $response = [
            'message' => 'Stok',
            'data' => $data
        ];
        // dd($data);

        return response()->json($response, Response::HTTP_OK);
    }

    public function index(){
        return view('dashboard.index');
    }
}
