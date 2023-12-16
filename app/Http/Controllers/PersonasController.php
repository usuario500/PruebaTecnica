<?php
namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonasController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return response()->json($personas);
    }
    public function find($id){
        $resultados = Persona::where('id', $id)->get();
        return response()->json($resultados);
    }
    public function insercion(Request $request){
        $input = $request->all();
        DB::statement("SELECT insertar(?, ?)",
         [$input['nombre'], $input['edad']]);

        return response()->json([
            'res'=>true,
            'message'=>'persona insertada'
        ]);
    }
    public function update($id, Request $request){
        $input = $request->all();
        $Personas = Persona::find($id);
        $Personas -> update($input);
        return response()->json([
            'res'=>true,
            'message'=>'persona actualizada'
        ]);
    }
    public function delete($id){
        Persona::destroy($id);
        return response()->json([
            'res'=>true,
            'message'=>'persona eliminada'
        ]);
    }
    
}