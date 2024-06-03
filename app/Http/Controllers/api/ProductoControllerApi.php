<?php

namespace App\Http\Controllers\api;
use App\Http\Models\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductoControllerApi extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return response()->json($productos);
    }
}
