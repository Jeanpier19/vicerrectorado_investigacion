<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoConvocatoria;
use Illuminate\Support\Str;

class TipoConvocatoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = TipoConvocatoria::where(function ($query) use ($search) {
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
        $update = TipoConvocatoria::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Tipo de Convocatoria se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Tipo de Convocatoria se activó correctamente';
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
            'nombre.unique' => 'El Tipo de Convocatoria ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_convocatorias,nombre',
        ], $messages);
        // create tipo_convocatoria
        $tipo_convocatoria = new TipoConvocatoria;
        $tipo_convocatoria->user_id = auth('api')->user()->id;
        $tipo_convocatoria->nombre = $nombre;
        $tipo_convocatoria->slug = Str::slug($nombre);
        $tipo_convocatoria->main = $main;
        $tipo_convocatoria->active = 1; 
        $tipo_convocatoria->save();
        $result = 1;
        $message = 'El Tipo de Convocatoria se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $tipo_convocatoria = TipoConvocatoria::findOrFail($id);
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
            'nombre.unique' => 'El Tipo de Convocatoria ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_convocatorias,nombre,' . $id,
        ], $messages);
        // create tipo_convocatoria
        $tipo_convocatoria->user_id = auth('api')->user()->id;
        $tipo_convocatoria->nombre = $nombre;
        $tipo_convocatoria->slug = Str::slug($nombre);
        $tipo_convocatoria->main = $main;
        $tipo_convocatoria->save();
        $result = 1;
        $message = 'El Tipo de Convocatoria se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = TipoConvocatoria::findOrFail($id);
        if($delete->convocatorias()->count()) {
            $result = 0;
            $message = 'El Tipo de Convocatoria no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Tipo de Convocatoria se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
