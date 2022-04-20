<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        $response = [
            'message' => 'Stok Kendaraan',
            // 'data' => count($kendaraan),
            'data' => $kendaraan
        ];

        return response()->json($response, Response::HTTP_OK);
        // return view('kendaraans.index', compact('kendaraan'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $kendaraan = Kendaraan::create($request->all());
            $response = [
                'message' => 'Create Kendaraan',
                'data' => $kendaraan
            ];
            
            return response()->json($response, Response::HTTP_CREATED);
        }catch(QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        
        $response = [
            'message' => 'Detail Kendaraan',
            'data' => $kendaraan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        try{
            $kendaraan->update($request->all());
            $response = [
                'message' => 'Update Kendaraan',
                'data' => $kendaraan
            ];
            
            return response()->json($response, Response::HTTP_OK);
        }catch(QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        
        try{
            $kendaraan->delete();
            $response = [
                'message' => 'Delete Kendaraan',
            ];
            
            return response()->json($response, Response::HTTP_OK);
        }catch(QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }
}
