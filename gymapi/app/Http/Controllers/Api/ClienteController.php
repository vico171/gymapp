<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function item($id) {

        $clientes = Cliente::where('id','=',$id)->first();

        $object = [
            "id" => $clientes->id,
            "nombre" => $clientes->nombre,
            "apellidos" => $clientes->apellidos,
            "edad" => $clientes->edad,
            "celular" => $clientes->celular,
            "created" => $clientes->created_at,
            "updated" => $clientes->updated_at
        ];

        return response()->json($object);
    }

    
}
