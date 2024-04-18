<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function item($id) {

        $usuarios = User::where('id','=',$id)->first();

        $object = [

            "name" => $usuarios->name,
            "email" => $usuarios->email

        ];

        return response()->json($object);
    }

    
}
