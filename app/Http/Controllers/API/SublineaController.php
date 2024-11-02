<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Linea;
use App\Sublinea;
use Illuminate\Support\Str;

class SublineaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Sublinea::with('linea')
            ->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('numero')
            ->latest('updated_at')
            ->paginate(10);
        $lineas = Linea::where('active', 1)
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
            'lineas' => $lineas,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Sublinea::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Sublínea de Investigación se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Sublínea de Investigación se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $linea_id = $request->linea_id;
        $numero = $request->numero;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'numero.required' => 'Falta ingresar el número',
            'numero.numeric' => 'Ingrese un Número válido',
            'numero.min' => 'El Número debe ser mayor o igual a 1',
            'nombre.required' => 'Falta ingresar el Nombre',
            'nombre.unique' => 'La Sublínea de Investigación ya existe',
            'linea_id.required' => 'Falta seleccionar el Área',
        ];
        $this->validate($request, [
            'main' => 'required',
            'numero' => 'required|numeric|min:1',
            'nombre' => 'required|unique:sublineas,nombre',
            'linea_id' => 'required',
        ], $messages);
        // create linea
        $sublinea = new Sublinea;
        $sublinea->user_id = auth('api')->user()->id;
        $sublinea->linea_id = $linea_id;
        $sublinea->numero = $numero;
        $sublinea->nombre = $nombre;
        $sublinea->slug = Str::slug($nombre);
        $sublinea->main = $main;
        $sublinea->active = 1; 
        $sublinea->save();
        $result = 1;
        $message = 'La Sublínea de Investigación se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $sublinea = Sublinea::findOrFail($id);
        // data from request
        $linea_id = $request->linea_id;
        $numero = $request->numero;
        $nombre = $request->nombre;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'numero.required' => 'Falta ingresar el número',
            'numero.numeric' => 'Ingrese un Número válido',
            'numero.min' => 'El Número debe ser mayor o igual a 1',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'La Sublínea de Investigación ya existe',
            'linea_id.required' => 'Falta seleccionar el Área',
        ];
        $this->validate($request, [
            'main' => 'required',
            'numero' => 'required|numeric|min:1',
            'nombre' => 'required|unique:sublineas,nombre,' . $id,
            'linea_id' => 'required',
        ], $messages);
        // create linea
        $sublinea->user_id = auth('api')->user()->id;
        $sublinea->linea_id = $linea_id;
        $sublinea->numero = $numero;
        $sublinea->nombre = $nombre;
        $sublinea->slug = Str::slug($nombre);
        $sublinea->main = $main;
        $sublinea->save();
        $result = 1;
        $message = 'La Sublínea de Investigación se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Sublinea::findOrFail($id);
        if($delete->circulos()->count()) {
            $result = 0;
            $message = 'La Sublínea de Investigación no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'La Sublínea de Investigación se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
