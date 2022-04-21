<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Mobil;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobil = Mobil::all();
        $response = [
            'message' => 'Stok Kendaraan',
            'data' => $mobil
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
        try {
            $mobil = Mobil::create($request->all());
            $response = [
                'message' => 'Create Mobil',
                'data' => $mobil
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mobil = Mobil::findOrFail($id);

        $response = [
            'message' => 'Detail Mobil',
            'data' => $mobil
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        try {
            $mobil->update($request->all());
            $response = [
                'message' => 'Update Mobil',
                'data' => $mobil
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        try {
            $mobil->delete();
            $response = [
                'message' => 'Delete Mobil',
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function status($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobilcheck = Mobil::where('_id', $id)->whereNotNull('terjual')->first();
        $date = Carbon::now()->toDateTimeString();
        
        try {
            if ($mobilcheck === null) {
                $update['terjual'] = $date;
            }else{
                $update['terjual'] = NULL;
            }
            $mobil->update($update);
            
            $response = [
                'message' => 'Update Mobil',
                'data' => $mobil
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function showIndex()
    {
        return view('mobils.index');
    }

    public function showCreate()
    {
        return view('mobils.create');
    }

    public function showEdit($id)
    {
        $mobil = Mobil::find($id);
        $kendaraan = Kendaraan::find($mobil->kendaraan);
        return view('mobils.edit', compact('mobil', 'kendaraan', 'id'));
    }
}
