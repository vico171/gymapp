<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rutina;

class RutinasController extends Controller
{
    public function item($id) {

        $rutinas = Rutina::where('id','=',$id)->first();

        $object = [
            "id" => $rutinas->id,
            "descripcion" => $rutinas->descripcion,
            "tiempo" => $rutinas->tiempo,
            "repeticiones" => $rutinas->repeticiones,
            "imagen" => $rutinas->imagen,
            "created" => $rutinas->created_at,
            "updated" => $rutinas->updated_at
        ];

        return response()->json($object);
    }

    public function list() {

        $rutinas = Rutina::all();
        $list=[];
        foreach($rutinas as $rutina){
            $object = [
                "id" => $rutina->id,
                "descripcion" => $rutina->descripcion,
                "tiempo" => $rutina->tiempo,
                "repeticiones" => $rutina->repeticiones,
                "imagen" => $rutina->imagen,
                "created" => $rutina->created_at,
                "updated" => $rutina->updated_at
            ];

            array_push($list,$object);

        }

       

        return response()->json($list);
    }
    public function create(Request $request ){
        $data = $request->validate([
            'descripcion' => 'required',
            'tiempo' => 'required|numeric',
            'repeticiones' => 'required|numeric',
            'imagen' => 'required',

        ]);
        
        $rutina = Rutina::create([
            'descripcion' => $data['descripcion'],
            'tiempo' => $data['tiempo'],
            'repeticiones' => $data['repeticiones'],
            'imagen' => $data['imagen']

        ]);

        if ($rutina) {
            return response()->json([
                'message' => 'Los datos ingresados son los siguientes:',
                'info' => $rutina
            ]);
        } else {
            return response()->json([
                'message' => 'Error al crear los datos'
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $rutina = Rutina::findOrFail($id);
            $rutina->delete();

            return response()->json(['message' => 'Registro eliminado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar el registro'], 500);
        }
    }
    

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $rutinas = Rutina::where('descripcion', 'like', '%' . $keyword . '%')
            ->get();
        $list = [];



        foreach ($rutinas as $rutina) {
            $object = [
                "id" => $rutina->id,
                "descripcion" => $rutina->descripcion,
                "tiempo" => $rutina->tiempo,
                "repeticiones" => $rutina->repeticiones,
                "imagen" => $rutina->imagen,
                "created" => $rutina->created_at,
                "updated" => $rutina->updated_at,
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function updateRutina(Request $request, $rutinaId)
    {
        try {
            $rutina = Rutina::findOrFail($rutinaId);
        
            $validatedData = $request->validate([
                'descripcion' => 'nullable|max:55',
                'tiempo' => 'nullable',
                'repeticiones' => 'nullable',
            ]);
    
            $updated = false;
    
            if ($request->filled('descripcion')) {
                $rutina->descripcion = $validatedData['descripcion'];
                $updated = true;
            }
    
            if ($request->filled('tiempo')) {
                $rutina->tiempo = $validatedData['tiempo'];
                $updated = true;
            }
    
            if ($request->filled('repeticiones')) {
                $rutina->repeticiones = $validatedData['repeticiones'];
                $updated = true;
            }
    
            if ($updated) {
                $rutina->save();
            }
    
            return response()->json([
                'message' => $updated ? 'Rutina actualizada correctamente' : 'No se realizaron cambios',
                'profile' => $rutina,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Se produjo un error al procesar la solicitud: ' . $e->getMessage(),
            ], 500);
        }
    }

    

}
