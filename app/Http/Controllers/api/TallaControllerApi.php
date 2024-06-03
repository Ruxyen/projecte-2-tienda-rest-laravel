<?php

namespace App\Http\Controllers\api;
use App\Http\Models\Talla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TallaControllerApi extends Controller
{
    public function index()
    {
        $tallas = Talla::all();

        return response()->json($tallas);
    }
}
