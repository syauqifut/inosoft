<?php

namespace App\Repository\Kendaraan;

use Illuminate\Http\Request;

interface KendaraanRepository
{
    public function store(Request $request);
    public function index();
    public function show($id);
    public function update(Request $request, $id);
    public function destroy($id);
}

?>