<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoInstitucion;
use Illuminate\Support\Str;

class TipoInstitucionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = TipoInstitucion::where(function ($query) use ($search) {
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
        $update = TipoInstitucion::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Tipo de Institución se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Tipo de Institución se activó correctamente';
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
            'nombre.unique' => 'El Tipo de Institución ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_institucions,nombre',
        ], $messages);
        // create tipo_institucion
        $tipo_institucion = new TipoInstitucion;
        $tipo_institucion->user_id = auth('api')->user()->id;
        $tipo_institucion->nombre = $nombre;
        $tipo_institucion->slug = Str::slug($nombre);
        $tipo_institucion->main = $main;
        $tipo_institucion->active = 1; 
        $tipo_institucion->save();
        $result = 1;
        $message = 'El Tipo de Institución se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $tipo_institucion = TipoInstitucion::findOrFail($id);
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
            'nombre.unique' => 'El Tipo de Institución ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_institucions,nombre,' . $id,
        ], $messages);
        // create tipo_institucion
        $tipo_institucion->user_id = auth('api')->user()->id;
        $tipo_institucion->nombre = $nombre;
        $tipo_institucion->slug = Str::slug($nombre);
        $tipo_institucion->main = $main;
        $tipo_institucion->save();
        $result = 1;
        $message = 'El Tipo de Institución se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = TipoInstitucion::findOrFail($id);
        if($delete->institucions()->count()) {
            $result = 0;
            $message = 'El Tipo de Institución no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Tipo de Institución se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
