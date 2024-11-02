<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Linea;
use App\Grupo;
use Illuminate\Support\Str;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }
    
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Grupo::with('linea')
        ->where(function ($query) use ($search) {
            $query->where('nombre', 'like', '%' . $search . '%');
        })
        ->orderBy('id', 'desc')
        ->latest('updated_at')
        ->paginate(10);
        $lineas = Linea::where('active', 1)
        ->orderBy('main', 'desc')
        ->orderBy('nombre')
        ->get();
        $response = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'items' => $items,
            'lineas' => $lineas,
        ];
        return response()->json($response);
    }
    
    public function enable_disable($activo, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Grupo::findOrFail($id);
        $update->activo = $activo;
        $update->save();
        // response message
        if($activo == 0) {
            $message = 'El Grupo de Investigación se desactivó correctamente';
        }elseif($activo == 1) {
            $message = 'El Grupo de Investigación se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
    
    public function store(Request $request)
    {
        // data from request
        $linea_id = $request->linea_id;
        $nombre = $request->nombre;
        $integrantes = $request->integrantes;
        $producciones = $request->producciones;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'nombre.required' => 'Falta ingresar el Nombre',
            'linea_id.required' => 'Falta seleccionar la Linea de Investigación',
        ];
        $this->validate($request, [
            'nombre' => 'required|unique:grupos,nombre',
            'linea_id' => 'required',
        ], $messages);
        // create linea
        $grupo = new Grupo;
        $grupo->linea_id = $linea_id;
        $grupo->nombre = $nombre;
        $grupo->integrantes = $integrantes;
        $grupo->producciones = $producciones;
        $grupo->estado = 1; 
        $grupo->activo = 1; 
        $grupo->borrado = 0; 
        $grupo->save();
        $result = 1;
        $message = 'El Grupo de Investigación se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
    
    public function show($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        // update
        $grupo = Grupo::findOrFail($id);
        // data from request
        $linea_id = $request->linea_id;
        $nombre = $request->nombre;
        $integrantes = $request->integrantes;
        $producciones = $request->producciones;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'nombre.required' => 'Falta ingresar el nombre',
            'linea_id.required' => 'Falta seleccionar la Linea de Investigacion',
        ];
        $this->validate($request, [
            'nombre' => 'required|unique:grupos,nombre,' . $id,
            'linea_id' => 'required',
        ], $messages);
        // create linea
        $grupo->linea_id = $linea_id;
        $grupo->nombre = $nombre;
        $grupo->integrantes = $integrantes;
        $grupo->producciones = $producciones;
        $grupo->estado = 1; 
        $grupo->activo = 1; 
        $grupo->borrado = 0; 
        $grupo->save();
        $result = 1;
        $message = 'El Grupo de Investigación se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
    
    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Grupo::findOrFail($id);
        $delete->delete();
        $message = 'El Grupo de Investigación se eliminó correctamente';
        
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
