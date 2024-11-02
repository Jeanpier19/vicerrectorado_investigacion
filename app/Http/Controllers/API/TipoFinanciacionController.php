<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoFinanciacion;
use Illuminate\Support\Str;

class TipoFinanciacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = TipoFinanciacion::where(function ($query) use ($search) {
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
        $update = TipoFinanciacion::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Tipo de Financiación se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Tipo de Financiación se activó correctamente';
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
            'nombre.unique' => 'El Tipo de Financiación ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_financiacions,nombre',
        ], $messages);
        // create tipo_financiacion
        $tipo_financiacion = new TipoFinanciacion;
        $tipo_financiacion->user_id = auth('api')->user()->id;
        $tipo_financiacion->nombre = $nombre;
        $tipo_financiacion->slug = Str::slug($nombre);
        $tipo_financiacion->main = $main;
        $tipo_financiacion->active = 1; 
        $tipo_financiacion->save();
        $result = 1;
        $message = 'El Tipo de Financiación se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $tipo_financiacion = TipoFinanciacion::findOrFail($id);
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
            'nombre.unique' => 'El Tipo de Financiación ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:tipo_financiacions,nombre,' . $id,
        ], $messages);
        // create tipo_financiacion
        $tipo_financiacion->user_id = auth('api')->user()->id;
        $tipo_financiacion->nombre = $nombre;
        $tipo_financiacion->slug = Str::slug($nombre);
        $tipo_financiacion->main = $main;
        $tipo_financiacion->save();
        $result = 1;
        $message = 'El Tipo de Financiación se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = TipoFinanciacion::findOrFail($id);
        if($delete->proyectos()->count()) {
            $result = 0;
            $message = 'El Tipo de Financiación no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Tipo de Financiación se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
