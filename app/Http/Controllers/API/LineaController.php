<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\Linea;
use Illuminate\Support\Str;

class LineaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Linea::with('area')
            ->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->latest('updated_at')
            ->paginate(10);
        $areas = Area::where('active', 1)
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
            'areas' => $areas,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Linea::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Línea de Investigación se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Línea de Investigación se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $area_id = $request->area_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'nombre.required' => 'Falta ingresar el Nombre',
            'nombre.unique' => 'La Línea de Investigación ya existe',
            'area_id.required' => 'Falta seleccionar el Área',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:lineas,nombre',
            'area_id' => 'required',
        ], $messages);
        // create linea
        $linea = new Linea;
        $linea->user_id = auth('api')->user()->id;
        $linea->area_id = $area_id;
        $linea->nombre = $nombre;
        $linea->slug = Str::slug($nombre);
        $linea->main = $main;
        $linea->active = 1; 
        $linea->save();
        $result = 1;
        $message = 'La Línea de Investigación se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $linea = Linea::findOrFail($id);
        // data from request
        $area_id = $request->area_id;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'La Línea de Investigación ya existe',
            'area_id.required' => 'Falta seleccionar el Área',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:lineas,nombre,' . $id,
            'area_id' => 'required',
        ], $messages);
        // create linea
        $linea->user_id = auth('api')->user()->id;
        $linea->area_id = $area_id;
        $linea->nombre = $nombre;
        $linea->slug = Str::slug($nombre);
        $linea->main = $main;
        $linea->save();
        $result = 1;
        $message = 'La Línea de Investigación se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Linea::findOrFail($id);
        if($delete->sublineas()->count()) {
            $result = 0;
            $message = 'La Línea de Investigación no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'La Línea de Investigación se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
