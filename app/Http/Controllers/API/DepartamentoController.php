<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facultad;
use App\Departamento;
use Illuminate\Support\Str;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function get_departamentos(Request $request) {
        $facultad_id = $request->facultad_id;
        $departamentos = Departamento::where('active', 1)
            ->where('facultad_id', $facultad_id)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $response = [
            'departamentos' => $departamentos,
        ];
        return response()->json($response);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Departamento::with('facultad')
            ->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->latest('updated_at')
            ->paginate(10);
        $facultades = Facultad::where('active', 1)
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
            'facultades' => $facultades,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Departamento::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Departamento Académico se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Departamento Académico se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $facultad_id = $request->facultad_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'nombre.required' => 'Falta ingresar el Nombre',
            'nombre.unique' => 'El Departamento Académico ya existe',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:departamentos,nombre',
            'facultad_id' => 'required',
        ], $messages);
        // create departamento
        $departamento = new Departamento;
        $departamento->user_id = auth('api')->user()->id;
        $departamento->facultad_id = $facultad_id;
        $departamento->nombre = $nombre;
        $departamento->slug = Str::slug($nombre);
        $departamento->main = $main;
        $departamento->active = 1; 
        $departamento->save();
        $result = 1;
        $message = 'El Departamento Académico se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $departamento = Departamento::findOrFail($id);
        // data from request
        $facultad_id = $request->facultad_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'El Departamento Académico ya existe',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:departamentos,nombre,' . $id,
            'facultad_id' => 'required',
        ], $messages);
        // create departamento
        $departamento->user_id = auth('api')->user()->id;
        $departamento->facultad_id = $facultad_id;
        $departamento->nombre = $nombre;
        $departamento->slug = Str::slug($nombre);
        $departamento->main = $main;
        $departamento->save();
        $result = 1;
        $message = 'El Departamento Académico se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Departamento::findOrFail($id);
        if($delete->investigadors()->count()) {
            $result = 0;
            $message = 'El Departamento Académico no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Departamento Académico se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
