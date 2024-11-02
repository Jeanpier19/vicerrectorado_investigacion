<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GrupoConvenioEspecifico;
use Illuminate\Support\Str;

class GrupoConvenioEspecificoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = GrupoConvenioEspecifico::where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->latest('updated_at')
            ->paginate(10);
        $response = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'items' => $items
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = GrupoConvenioEspecifico::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Grupo de Convenio Específico se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Grupo de Convenio Específico se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'El Grupo de Convenio Específico ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:grupo_convenio_especificos,nombre',
        ], $messages);
        // create grupo_convenio_especifico
        $grupo_convenio_especifico = new GrupoConvenioEspecifico;
        $grupo_convenio_especifico->user_id = auth('api')->user()->id;
        $grupo_convenio_especifico->nombre = $nombre;
        $grupo_convenio_especifico->slug = Str::slug($nombre);
        $grupo_convenio_especifico->main = $main;
        $grupo_convenio_especifico->active = 1; 
        $grupo_convenio_especifico->save();
        $result = 1;
        $message = 'El Grupo de Convenio Específico se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $grupo_convenio_especifico = GrupoConvenioEspecifico::findOrFail($id);
        // data from request
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'El Grupo de Convenio Específico ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:grupo_convenio_especificos,nombre,' . $id,
        ], $messages);
        // create grupo_convenio_especifico
        $grupo_convenio_especifico->user_id = auth('api')->user()->id;
        $grupo_convenio_especifico->nombre = $nombre;
        $grupo_convenio_especifico->slug = Str::slug($nombre);
        $grupo_convenio_especifico->main = $main;
        $grupo_convenio_especifico->save();
        $result = 1;
        $message = 'El Grupo de Convenio Específico se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = GrupoConvenioEspecifico::findOrFail($id);
        if($delete->tipo_convenio_especificos()->count()) {
            $result = 0;
            $message = 'El Grupo de Convenio Específico no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Grupo de Convenio Específico se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
