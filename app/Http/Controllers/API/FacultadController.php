<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facultad;
use Illuminate\Support\Str;

class FacultadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function get_facultades() {
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $response = [
            'facultades' => $facultades,
        ];
        return response()->json($response);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Facultad::where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
                $query->orWhere('abreviatura', 'like', '%' . $search . '%');
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
        $update = Facultad::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Facultad se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Facultad se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $nombre = $request->nombre;
        $abreviatura = $request->abreviatura;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'nombre.required' => 'Falta ingresar el Nombre',
            'nombre.unique' => 'La Facultad ya existe',
            'abreviatura.required' => 'Falta ingresar la Abreviatura',
            'abreviatura.unique' => 'La Abreviatura de la Facultad ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:facultads,nombre',
            'abreviatura' => 'required|unique:facultads,abreviatura',
        ], $messages);
        // create facultad
        $facultad = new Facultad;
        $facultad->user_id = auth('api')->user()->id;
        $facultad->nombre = $nombre;
        $facultad->slug = Str::slug($nombre);
        $facultad->abreviatura = $abreviatura;
        $facultad->main = $main;
        $facultad->active = 1; 
        $facultad->save();
        $result = 1;
        $message = 'La Facultad se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $facultad = Facultad::findOrFail($id);
        // data from request
        $nombre = $request->nombre;
        $abreviatura = $request->abreviatura;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la prioridad',
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'La Facultad ya existe',
            'abreviatura.required' => 'Falta ingresar la Abreviatura',
            'abreviatura.unique' => 'La Abreviatura de la Facultad ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'nombre' => 'required|unique:facultads,nombre,' . $id,
            'abreviatura' => 'required|unique:facultads,abreviatura,' . $id,
        ], $messages);
        // create facultad
        $facultad->user_id = auth('api')->user()->id;
        $facultad->nombre = $nombre;
        $facultad->slug = Str::slug($nombre);
        $facultad->abreviatura = $abreviatura;
        $facultad->main = $main;
        $facultad->save();
        $result = 1;
        $message = 'La Facultad se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Facultad::findOrFail($id);
        if($delete->departamentos()->count()) {
            $result = 0;
            $message = 'La Facultad no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'La Facultad se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
