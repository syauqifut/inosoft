<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Mobil;
use App\Repository\Mobil\MobilRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MobilController extends Controller
{
    private MobilRepository $EloquentMobil;

    public function __construct(MobilRepository $EloquentMobil) 
    {
        $this->EloquentMobil = $EloquentMobil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobil = $this->EloquentMobil->index();
        $response = [
            'message' => 'Mobil',
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
            $mobil = $this->EloquentMobil->store($request);
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
        $mobil = $this->EloquentMobil->show($id);

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
        try {
            $mobil = $this->EloquentMobil->update($request, $id);
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
        try {
            $mobil = $this->EloquentMobil->destroy($id);
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
        try {
            $mobil = $this->EloquentMobil->status($id);
            
            $response = [
                'message' => 'Update Mobil',
                'data' => $mobil
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function sold()
    {
        $mobil = $this->EloquentMobil->sold();
        $response = [
            'message' => 'Mobil',
            'data' => $mobil
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function showDetailMobil($id)
    {
        $mobil = $this->EloquentMobil->showDetailMobil($id);
        $kendaraan = $this->EloquentMobil->showDetailMobilKendaraan($mobil);
        return view('dashboard.detailMobil', compact('mobil', 'kendaraan', 'id'));
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
