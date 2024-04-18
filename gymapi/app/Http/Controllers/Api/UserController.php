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

    public function updatePerfil(Request $request, $perfilId)
    {
        try {
            $perfil = User::findOrFail($perfilId);
        
            $validatedData = $request->validate([
                'name' => 'nullable|max:55',
                'email' => 'nullable',
                
            ]);
    
            $updated = false;
    
            if ($request->filled('name')) {
                $perfil->name = $validatedData['name'];
                $updated = true;
            }
    
            if ($request->filled('email')) {
                $perfil->email = $validatedData['email'];
                $updated = true;
            }
    
           
    
            if ($updated) {
                $perfil->save();
            }
    
            return response()->json([
                'message' => $updated ? 'Perfil actualizado correctamente' : 'No se realizaron cambios',
                'profile' => $perfil,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Se produjo un error al procesar la solicitud: ' . $e->getMessage(),
            ], 500);
        }
    }

    
}
