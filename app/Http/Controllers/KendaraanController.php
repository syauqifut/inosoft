<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Repository\Kendaraan\KendaraanRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KendaraanController extends Controller
{
    private KendaraanRepository $EloquentKendaraan;

    public function __construct(KendaraanRepository $EloquentKendaraan) 
    {
        $this->EloquentKendaraan = $EloquentKendaraan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = $this->EloquentKendaraan->index();
        $response = [
            'message' => 'Stok Kendaraan',
            'data' => $kendaraan
        ];

        return response()->json($response, Response::HTTP_OK);
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
            $kendaraan = $this->EloquentKendaraan->store($request);
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
        $kendaraan = $this->EloquentKendaraan->show($id);
        
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
        
        try{
            $kendaraan = $this->EloquentKendaraan->store($request, $id);
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
        
        try{
            $kendaraan = $this->EloquentKendaraan->destroy($id);
            $response = [
                'message' => 'Delete Kendaraan',
            ];
            
            return response()->json($response, Response::HTTP_OK);
        }catch(QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function showIndex()
    { 
        return view('kendaraans.index');
    }

    public function showCreate()
    {
        return view('kendaraans.create');
    }

    public function showEdit($id)
    {
        $kendaraan = Kendaraan::find($id);
        return view('kendaraans.edit', compact('kendaraan','id'));
    }
}
