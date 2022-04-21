<?php

namespace App\Repository\Mobil;

use Illuminate\Http\Request;

interface MobilRepository
{
    public function store(Request $request);
    public function index();
    public function show($id);
    public function update(Request $request, $id);
    public function destroy($id);
    public function status($id);
    public function sold();
    public function showDetailMobil($id);
    public function showDetailMobilKendaraan($mobil);
}

?>