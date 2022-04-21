<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Motor;
use App\Repository\Motor\MotorRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MotorController extends Controller
{
    private MotorRepository $EloquentMotor;

    public function __construct(MotorRepository $EloquentMotor) 
    {
        $this->EloquentMotor = $EloquentMotor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motor = $this->EloquentMotor->index();
        $response = [
            'message' => 'Motor',
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
            $motor = $this->EloquentMotor->store($request);
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
        $motor = $this->EloquentMotor->show($id);

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
        try {
            $motor = $this->EloquentMotor->update($request, $id);
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
        try {
            $motor = $this->EloquentMotor->destroy($id);;
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
        
        try {
            $motor = $this->EloquentMotor->status($id);
            
            $response = [
                'message' => 'Update Motor',
                'data' => $motor
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed' . $e->errorInfo]);
        }
    }

    public function sold()
    {
        $motor = $this->EloquentMotor->sold();
        $response = [
            'message' => 'Motor',
            'data' => $motor
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function showDetailMotor($id)
    {
        $motor = $this->EloquentMotor->showDetailMotor($id);
        $kendaraan = $this->EloquentMotor->showDetailMotorKendaraan($motor);
        return view('dashboard.detailMotor', compact('motor', 'kendaraan', 'id'));
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
