<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Motor;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motor = Motor::all();
        $response = [
            'message' => 'Stok Kendaraan',
            'data' => $motor
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
            $motor = Motor::create($request->all());
            $response = [
                'message' => 'Create Motor',
                'data' => $motor
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motor = Motor::findOrFail($id);

        $response = [
            'message' => 'Detail Motor',
            'data' => $motor
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);

        try {
            $motor->update($request->all());
            $response = [
                'message' => 'Update Motor',
                'data' => $motor
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);

        try {
            $motor->delete();
            $response = [
                'message' => 'Delete Motor',
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function status($id)
    {
        $motor = Motor::findOrFail($id);
        $motorcheck = Motor::where('_id', $id)->whereNotNull('terjual')->first();
        $date = Carbon::now()->toDateTimeString();
        
        try {
            if ($motorcheck === null) {
                $update['terjual'] = $date;
            }else{
                $update['terjual'] = NULL;
            }
            $motor->update($update);
            
            $response = [
                'message' => 'Update Motor',
                'data' => $motor
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function showIndex()
    {
        return view('motors.index');
    }

    public function showCreate()
    {
        return view('motors.create');
    }

    public function showEdit($id)
    {
        $motor = Motor::find($id);
        $kendaraan = Kendaraan::find($motor->kendaraan);
        return view('motors.edit', compact('motor', 'kendaraan', 'id'));
    }
}
