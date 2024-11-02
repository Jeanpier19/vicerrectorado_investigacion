<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Area::where(function ($query) use ($search) {
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
        $update = Area::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Área de Investigación se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Área de Investigación se activó correctamente';
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
            'nombre.unique' => 'El Área de Investigación ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:areas,nombre',
        ], $messages);
        // create area
        $area = new Area;
        $area->user_id = auth('api')->user()->id;
        $area->nombre = $nombre;
        $area->slug = Str::slug($nombre);
        $area->main = $main;
        $area->active = 1; 
        $area->save();
        $result = 1;
        $message = 'El Área de Investigación se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $area = Area::findOrFail($id);
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
            'nombre.unique' => 'El Área de Investigación ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:areas,nombre,' . $id,
        ], $messages);
        // create area
        $area->user_id = auth('api')->user()->id;
        $area->nombre = $nombre;
        $area->slug = Str::slug($nombre);
        $area->main = $main;
        $area->save();
        $result = 1;
        $message = 'El Área de Investigación se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Area::findOrFail($id);
        if($delete->lineas()->count()) {
            $result = 0;
            $message = 'El Área de Investigación no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Área de Investigación se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
