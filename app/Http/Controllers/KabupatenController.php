<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_Kabupaten;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Tb_Kabupaten::all();
        return response()->json($kabupatens);
    }
}
