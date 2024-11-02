<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoInstitucion;
use App\Institucion;
use Illuminate\Support\Str;

class InstitucionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Institucion::with('tipo_institucion')
            ->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->latest('updated_at')
            ->paginate(10);
        $tipos_institucion = TipoInstitucion::where('active', 1)
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
            'tipos_institucion' => $tipos_institucion,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Institucion::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Institución se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Institución se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $tipo_institucion_id = $request->tipo_institucion_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'nombre.required' => 'Falta ingresar el Nombre',
            'nombre.unique' => 'La Institución ya existe',
            'tipo_institucion_id.required' => 'Falta seleccionar la TipoInstitucion',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:institucions,nombre',
            'tipo_institucion_id' => 'required',
        ], $messages);
        // create institucion
        $institucion = new Institucion;
        $institucion->user_id = auth('api')->user()->id;
        $institucion->tipo_institucion_id = $tipo_institucion_id;
        $institucion->nombre = $nombre;
        $institucion->slug = Str::slug($nombre);
        $institucion->main = $main;
        $institucion->active = 1; 
        $institucion->save();
        $result = 1;
        $message = 'La Institución se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $institucion = Institucion::findOrFail($id);
        // data from request
        $tipo_institucion_id = $request->tipo_institucion_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'La Institución ya existe',
            'tipo_institucion_id.required' => 'Falta seleccionar la TipoInstitucion',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:institucions,nombre,' . $id,
            'tipo_institucion_id' => 'required',
        ], $messages);
        // create institucion
        $institucion->user_id = auth('api')->user()->id;
        $institucion->tipo_institucion_id = $tipo_institucion_id;
        $institucion->nombre = $nombre;
        $institucion->slug = Str::slug($nombre);
        $institucion->main = $main;
        $institucion->save();
        $result = 1;
        $message = 'La Institución se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Institucion::findOrFail($id);
        if($delete->convenios()->count()) {
            $result = 0;
            $message = 'La Institución no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'La Institución se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
