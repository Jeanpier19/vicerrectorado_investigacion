<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoPublicacion;
use Illuminate\Support\Str;

class TipoPublicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = TipoPublicacion::where(function ($query) use ($search) {
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
        $update = TipoPublicacion::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Tipo de Publicación se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Tipo de Publicación se activó correctamente';
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
            'nombre.unique' => 'El Tipo de Publicación ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_publicacions,nombre',
        ], $messages);
        // create tipo_publicacion
        $tipo_publicacion = new TipoPublicacion;
        $tipo_publicacion->user_id = auth('api')->user()->id;
        $tipo_publicacion->nombre = $nombre;
        $tipo_publicacion->slug = Str::slug($nombre);
        $tipo_publicacion->main = $main;
        $tipo_publicacion->active = 1; 
        $tipo_publicacion->save();
        $result = 1;
        $message = 'El Tipo de Publicación se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $tipo_publicacion = TipoPublicacion::findOrFail($id);
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
            'nombre.unique' => 'El Tipo de Publicación ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_publicacions,nombre,' . $id,
        ], $messages);
        // create tipo_publicacion
        $tipo_publicacion->user_id = auth('api')->user()->id;
        $tipo_publicacion->nombre = $nombre;
        $tipo_publicacion->slug = Str::slug($nombre);
        $tipo_publicacion->main = $main;
        $tipo_publicacion->save();
        $result = 1;
        $message = 'El Tipo de Publicación se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = TipoPublicacion::findOrFail($id);
        if($delete->publicacions()->count()) {
            $result = 0;
            $message = 'El Tipo de Publicación no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Tipo de Publicación se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
