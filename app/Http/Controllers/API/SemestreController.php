<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Semestre;
use Illuminate\Support\Str;

class SemestreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Semestre::where(function ($query) use ($search) {
                $query->where('anio', 'like', '%' . $search . '%');
                $query->orWhere('periodo', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('anio', 'desc')
            ->orderBy('periodo', 'desc')
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
        $update = Semestre::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Semestre se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Semestre se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }


    
    public function store(Request $request)
    {
        // data from request
        $anio = $request->anio;
        $periodo = $request->periodo;
        $main = $request->main;
        $slug = $request->slug;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'anio.required' => 'Falta ingresar el Nombre',
            'periodo.required' => 'Falta ingresar la Abreviatura',
            'slug.unique' => 'El Semestre ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'anio' => 'required',
            'periodo' => 'required',
            'slug' => 'unique:semestres,slug',
        ], $messages);
        // create semestre
        $semestre = new Semestre;
        $semestre->user_id = auth('api')->user()->id;
        $semestre->anio = $anio;
        $semestre->periodo = $periodo;
        $semestre->slug = Str::slug($slug);
        $semestre->main = $main;
        $semestre->active = 1; 
        $semestre->save();
        $result = 1;
        $message = 'El Semestre se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }



    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $semestre = Semestre::findOrFail($id);
        // data from request
        $anio = $request->anio;
        $periodo = $request->periodo;
        $main = $request->main;
        $slug = $request->slug;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'main.required' => 'Falta seleccionar la Prioridad',
            'anio.required' => 'Falta ingresar el Nombre',
            'periodo.required' => 'Falta ingresar la Abreviatura',
            'slug.unique' => 'El Semestre ya existe',
        ];
        $this->validate($request, [
            'main' => 'required',
            'anio' => 'required',
            'periodo' => 'required',
            'slug' => 'unique:semestres,slug,' . $semestre->id,
        ], $messages);
        // create semestre
        $semestre->user_id = auth('api')->user()->id;
        $semestre->anio = $anio;
        $semestre->periodo = $periodo;
        $semestre->slug = Str::slug($slug);
        $semestre->main = $main;
        $semestre->save();
        $result = 1;
        $message = 'El Semestre se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Semestre::findOrFail($id);
        if($delete->movilidads()->count()) {
            $result = 0;
            $message = 'El Semestre no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Semestre se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
