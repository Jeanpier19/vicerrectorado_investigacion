<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movilidad;
use App\Facultad;
use App\Institucion;
use App\Semestre;
use Validator;

class MovilidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Movilidad::with('facultad', 'institucion', 'semestre', 'files')
            ->where(function ($query) use ($search) {
                $query->where('nombres', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate(10);
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $instituciones = Institucion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $semestres = Semestre::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('anio', 'desc')
            ->orderBy('periodo', 'desc')
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
            'facultades' => $facultades,
            'instituciones' => $instituciones,
            'semestres' => $semestres,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Movilidad::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Movilidad se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Movilidad se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $tipo = $request->tipo;
        $institucion_id = $request->institucion_id;
        $facultad_id = $request->facultad_id;
        $semestre_id = $request->semestre_id;
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $modalidad = $request->modalidad;
        $pais = $request->pais;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'tipo.required' => 'Falta seleccionar el Tipo de Movilidad',
            'institucion_id.required' => 'Falta seleccionar la Institución',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
            'semestre_id.required' => 'Falta seleccionar el Semestre',
            'nombres.required' => 'Falta ingresar los Nombres',
            'apellidos.required' => 'Falta ingresar los Apellidos',
            'modalidad.required' => 'Falta seleccionar la Modalidad',
            'pais.required' => 'Falta ingresar el País',
            'main.required' => 'Falta seleccionar la prioridad',
        ];
        $this->validate($request, [
            'tipo' => 'required',
            'institucion_id' => 'required',
            'facultad_id' => 'required',
            'semestre_id' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'modalidad' => 'required',
            'pais' => 'required',
            'main' => 'required',
        ], $messages);
        // create movilidad
        $movilidad = new Movilidad;
        $movilidad->user_id = auth('api')->user()->id;
        $movilidad->tipo = $tipo;
        $movilidad->facultad_id = $facultad_id;
        $movilidad->institucion_id = $institucion_id;
        $movilidad->semestre_id = $semestre_id;
        $movilidad->nombres = $nombres;
        $movilidad->apellidos = $apellidos;
        $movilidad->pais = $pais;
        $movilidad->modalidad = $modalidad;
        $movilidad->main = $main;
        $movilidad->active = 1;
        $movilidad->save();
        $result = 1;
        $message = 'La Movilidad se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $movilidad = Movilidad::findOrFail($id);
        // data from request
        $tipo = $request->tipo;
        $institucion_id = $request->institucion_id;
        $facultad_id = $request->facultad_id;
        $semestre_id = $request->semestre_id;
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $modalidad = $request->modalidad;
        $pais = $request->pais;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'tipo.required' => 'Falta seleccionar el Tipo de Movilidad',
            'institucion_id.required' => 'Falta seleccionar la Institución',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
            'semestre_id.required' => 'Falta seleccionar el Semestre',
            'nombres.required' => 'Falta ingresar los Nombres',
            'apellidos.required' => 'Falta ingresar los Apellidos',
            'modalidad.required' => 'Falta seleccionar la Modalidad',
            'pais.required' => 'Falta ingresar el País',
            'main.required' => 'Falta seleccionar la prioridad',
        ];
        $this->validate($request, [
            'tipo' => 'required',
            'institucion_id' => 'required',
            'facultad_id' => 'required',
            'semestre_id' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'modalidad' => 'required',
            'pais' => 'required',
            'main' => 'required',
        ], $messages);
        // create movilidad
        $movilidad->user_id = auth('api')->user()->id;
        $movilidad->tipo = $tipo;
        $movilidad->facultad_id = $facultad_id;
        $movilidad->institucion_id = $institucion_id;
        $movilidad->semestre_id = $semestre_id;
        $movilidad->nombres = $nombres;
        $movilidad->apellidos = $apellidos;
        $movilidad->pais = $pais;
        $movilidad->modalidad = $modalidad;
        $movilidad->main = $main;
        $movilidad->save();
        $result = 1;
        $message = 'La Movilidad se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Movilidad::findOrFail($id);
        $delete->delete();
        $message = 'La Movilidad se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function add_documento(Request $request)
    {
        // request data
        $id = $request->id;
        $descripcion = $request->descripcion;
        $documento = $request->file('documento');
        // response data
        $result = 1;
        $message = '';
        // movilidad
        $movilidad = Movilidad::findOrFail($id);
        $input  = array('descripcion' => $descripcion);
        $reglas = array('descripcion' => 'required');
        $validator = Validator::make($input, $reglas);
        if($validator->fails()) {
            $result = 0;
            $message = 'Falta ingresar el nombre o descripción del documento';
        }else {
            if($documento != null) {
                $input  = array('documento' => $documento);
                $reglas = array('documento' => 'required||mimes:pdf');
                $validator = Validator::make($input, $reglas);
                if($validator->fails()) {
                    $result = 0;
                    $message = "El Documento no tiene una extensión válida, seleccione otro archivo";
                }else {
                    $fileName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $id;
                    $extension = $documento->getClientOriginalExtension();
                    $filePath = $fileName . "." . $extension;
                    $upload = $documento->move('archivos/documentos/movilidads/', $filePath);
                    if($upload) {
                        $movilidad->files()->create([
                            'name' => $descripcion,
                            'path' => $filePath,
                        ]);
                        $result = 1;
                        $message = "El documento se añadió correctamente";
                    }else {
                        $result = 0;
                        $message = "Error al subir el archivo, intente de nuevo más tarde";
                    }
                }
            }else {
                $result = 0;
                $message = 'Usted no ha seleccionado ningún documento';
            }
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
    public function delete_documento(Request $request)
    {
        $file_id = $request->file_id;
        $movilidad_id = $request->movilidad_id;
        $result = 1;
        $message = '';
        $delete = Movilidad::findOrFail($movilidad_id);
        $delete->files()->where('id', $file_id)->delete();
        $message = 'El documento se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
