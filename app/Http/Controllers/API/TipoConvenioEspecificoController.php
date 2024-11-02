<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GrupoConvenioEspecifico;
use App\TipoConvenioEspecifico;
use Illuminate\Support\Str;

class TipoConvenioEspecificoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = TipoConvenioEspecifico::with('grupo_convenio_especifico')
            ->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->latest('updated_at')
            ->paginate(10);
        $grupos_convenio_especifico = GrupoConvenioEspecifico::where('active', 1)
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
            'grupos_convenio_especifico' => $grupos_convenio_especifico,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = TipoConvenioEspecifico::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Tipo de Convenio Específico se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Tipo de Convenio Específico se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $grupo_convenio_especifico_id = $request->grupo_convenio_especifico_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'nombre.required' => 'Falta ingresar el Nombre',
            'nombre.unique' => 'El Tipo de Convenio Específico ya existe',
            'grupo_convenio_especifico_id.required' => 'Falta seleccionar El Grupo de Convenio Específico',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_convenio_especificos,nombre',
            'grupo_convenio_especifico_id' => 'required',
        ], $messages);
        // create tipo_convenio_especifico
        $tipo_convenio_especifico = new TipoConvenioEspecifico;
        $tipo_convenio_especifico->user_id = auth('api')->user()->id;
        $tipo_convenio_especifico->grupo_convenio_especifico_id = $grupo_convenio_especifico_id;
        $tipo_convenio_especifico->nombre = $nombre;
        $tipo_convenio_especifico->slug = Str::slug($nombre);
        $tipo_convenio_especifico->main = $main;
        $tipo_convenio_especifico->active = 1; 
        $tipo_convenio_especifico->save();
        $result = 1;
        $message = 'El Tipo de Convenio Específico se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $tipo_convenio_especifico = TipoConvenioEspecifico::findOrFail($id);
        // data from request
        $grupo_convenio_especifico_id = $request->grupo_convenio_especifico_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'El Tipo de Convenio Específico ya existe',
            'grupo_convenio_especifico_id.required' => 'Falta seleccionar El Grupo de Convenio Específico',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_convenio_especificos,nombre,' . $id,
            'grupo_convenio_especifico_id' => 'required',
        ], $messages);
        // create tipo_convenio_especifico
        $tipo_convenio_especifico->user_id = auth('api')->user()->id;
        $tipo_convenio_especifico->grupo_convenio_especifico_id = $grupo_convenio_especifico_id;
        $tipo_convenio_especifico->nombre = $nombre;
        $tipo_convenio_especifico->slug = Str::slug($nombre);
        $tipo_convenio_especifico->main = $main;
        $tipo_convenio_especifico->save();
        $result = 1;
        $message = 'El Tipo de Convenio Específico se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = TipoConvenioEspecifico::findOrFail($id);
        if($delete->convenios()->count()) {
            $result = 0;
            $message = 'El Tipo de Convenio Específico no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Tipo de Convenio Específico se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
