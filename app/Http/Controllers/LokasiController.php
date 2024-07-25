<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_Lokasi;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Tb_Lokasi::all();
        return response()->json($lokasis);
    }
}
