<?php

namespace App\Repository\Motor;

use Illuminate\Http\Request;

interface MotorRepository
{
    public function store(Request $request);
    public function index();
    public function show($id);
    public function update(Request $request, $id);
    public function destroy($id);
    public function status($id);
    public function sold();
    public function showDetailMotor($id);
    public function showDetailMotorKendaraan($motor);
}

?>