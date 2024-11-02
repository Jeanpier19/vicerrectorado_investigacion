<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Etiqueta;
use Illuminate\Support\Str;

class EtiquetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Etiqueta::where(function ($query) use ($search) {
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
        $update = Etiqueta::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Etiqueta se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Etiqueta se activó correctamente';
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
            'nombre.unique' => 'La Etiqueta ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:etiquetas,nombre',
        ], $messages);
        // create etiqueta
        $etiqueta = new Etiqueta;
        $etiqueta->user_id = auth('api')->user()->id;
        $etiqueta->nombre = $nombre;
        $etiqueta->slug = Str::slug($nombre);
        $etiqueta->main = $main;
        $etiqueta->active = 1; 
        $etiqueta->save();
        $result = 1;
        $message = 'La Etiqueta se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $etiqueta = Etiqueta::findOrFail($id);
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
            'nombre.unique' => 'La Etiqueta ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:etiquetas,nombre,' . $id,
        ], $messages);
        // create etiqueta
        $etiqueta->user_id = auth('api')->user()->id;
        $etiqueta->nombre = $nombre;
        $etiqueta->slug = Str::slug($nombre);
        $etiqueta->main = $main;
        $etiqueta->save();
        $result = 1;
        $message = 'La Etiqueta se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Etiqueta::findOrFail($id);
        if($delete->comunicados()->count()) {
            $result = 0;
            $message = 'La Etiqueta no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'La Etiqueta se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
