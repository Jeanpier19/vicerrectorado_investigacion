<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Convenio;
use App\Facultad;
use App\Institucion;
use App\TipoConvenioEspecifico;
use Validator;

class ConvenioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Convenio::with('facultad', 'institucion', 'tipo_convenio_especifico', 'files')
            ->where(function ($query) use ($search) {
                $query->where('objetivo', 'like', '%' . $search . '%');
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
        $tipos_convenio_especifico = TipoConvenioEspecifico::where('active', 1)
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
            'facultades' => $facultades,
            'instituciones' => $instituciones,
            'tipos_convenio_especifico' => $tipos_convenio_especifico,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Convenio::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Convenio se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Convenio se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $tipo = $request->tipo;
        $institucion_id = $request->institucion_id;
        $facultad_id = $request->facultad_id;
        $tipo_convenio_especifico_id = $request->tipo_convenio_especifico_id;
        $resolucion = $request->resolucion;
        $palabras_clave = $request->palabras_clave;
        $objetivo = $request->objetivo;
        $obligaciones = $request->obligaciones;
        $telefono = $request->telefono;
        $ambito = $request->ambito;
        $pais = $request->pais;
        $inicio = $request->inicio;
        $finalizacion = $request->finalizacion;
        $estado = $request->estado;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($palabras_clave == null) {
          $palabras_clave = '';
        }
        if($telefono == null) {
          $telefono = '';
        }
        // validation
        $messages = [
            'tipo.required' => 'Falta seleccionar el Tipo de Convenio',
            'institucion_id.required' => 'Falta seleccionar la Institución',
            'resolucion.required' => 'Falta ingresar la Resolución',
            'Objetivo.required' => 'Falta ingresar el Objetivo',
            'obligaciones.required' => 'Falta ingresar las Obligaciones',
            'ambito.required' => 'Falta seleccionar el Ámbito',
            'pais.required' => 'Falta ingresar el Pais',
            'inicio.required' => 'Falta ingresar la Fecha',
            'inicio.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'finalizacion.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'estado.required' => 'Falta seleccionar el Estado',
            'main.required' => 'Falta seleccionar la prioridad',
        ];
        $this->validate($request, [
            'tipo' => 'required',
            'institucion_id' => 'required',
            'resolucion' => 'required',
            'objetivo' => 'required',
            'obligaciones' => 'required',
            'ambito' => 'required',
            'pais' => 'required',
            'inicio' => 'required|date_format:"Y-m-d"',
            'finalizacion' => 'nullable|date_format:"Y-m-d"',
            'estado' => 'required',
            'main' => 'required',
        ], $messages);
        // create convenio
        $convenio = new Convenio;
        $convenio->user_id = auth('api')->user()->id;
        $convenio->tipo = $tipo;
        $convenio->institucion_id = $institucion_id;
        $convenio->resolucion = $resolucion;
        $convenio->palabras_clave = $palabras_clave;
        $convenio->objetivo = $objetivo;
        $convenio->obligaciones = $obligaciones;
        $convenio->telefono = $telefono;
        $convenio->ambito = $ambito;
        $convenio->pais = $pais;
        $convenio->inicio = $inicio;
        if($finalizacion) {
            $convenio->finalizacion = $finalizacion;
        }
        $convenio->estado = $estado;
        $convenio->main = $main;
        $convenio->active = 1;
        if($tipo == 1) {
            // validation
            $messages = [
                'facultad_id.required' => 'Falta seleccionar la Facultad',
                'tipo_convenio_especifico_id.required' => 'Falta seleccionar el Tipo de Convenio Específico',
            ];
            $this->validate($request, [
                'facultad_id' => 'required',
                'tipo_convenio_especifico_id' => 'required',
            ], $messages);
            $convenio->facultad_id = $facultad_id;
            $convenio->tipo_convenio_especifico_id = $tipo_convenio_especifico_id;
            $convenio->save();
        }else {
            $convenio->save();
        }
        $result = 1;
        $message = 'El Convenio se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $convenio = Convenio::findOrFail($id);
        // data from request
        $tipo = $request->tipo;
        $institucion_id = $request->institucion_id;
        $facultad_id = $request->facultad_id;
        $tipo_convenio_especifico_id = $request->tipo_convenio_especifico_id;
        $resolucion = $request->resolucion;
        $palabras_clave = $request->palabras_clave;
        $objetivo = $request->objetivo;
        $obligaciones = $request->obligaciones;
        $telefono = $request->telefono;
        $ambito = $request->ambito;
        $pais = $request->pais;
        $inicio = $request->inicio;
        $finalizacion = $request->finalizacion;
        $estado = $request->estado;
        $main = $request->main;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($palabras_clave == null) {
          $palabras_clave = '';
        }
        if($telefono == null) {
          $telefono = '';
        }
        // validation
        $messages = [
            'tipo.required' => 'Falta seleccionar el Tipo de Convenio',
            'institucion_id.required' => 'Falta seleccionar la Institución',
            'resolucion.required' => 'Falta ingresar la Resolución',
            'Objetivo.required' => 'Falta ingresar el Objetivo',
            'obligaciones.required' => 'Falta ingresar las Obligaciones',
            'ambito.required' => 'Falta seleccionar el Ámbito',
            'pais.required' => 'Falta ingresar el Pais',
            'inicio.required' => 'Falta ingresar la Fecha',
            'inicio.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'finalizacion.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'estado.required' => 'Falta seleccionar el Estado',
            'main.required' => 'Falta seleccionar la prioridad',
        ];
        $this->validate($request, [
            'tipo' => 'required',
            'institucion_id' => 'required',
            'resolucion' => 'required',
            'objetivo' => 'required',
            'obligaciones' => 'required',
            'ambito' => 'required',
            'pais' => 'required',
            'inicio' => 'required|date_format:"Y-m-d"',
            'finalizacion' => 'nullable|date_format:"Y-m-d"',
            'estado' => 'required',
            'main' => 'required',
        ], $messages);
        // update convenio
        $convenio->user_id = auth('api')->user()->id;
        $convenio->tipo = $tipo;
        $convenio->institucion_id = $institucion_id;
        $convenio->resolucion = $resolucion;
        $convenio->palabras_clave = $palabras_clave;
        $convenio->objetivo = $objetivo;
        $convenio->obligaciones = $obligaciones;
        $convenio->telefono = $telefono;
        $convenio->ambito = $ambito;
        $convenio->pais = $pais;
        $convenio->inicio = $inicio;
        if($finalizacion) {
            $convenio->finalizacion = $finalizacion;
        }
        $convenio->estado = $estado;
        $convenio->main = $main;
        if($tipo == 1) {
            // validation
            $messages = [
                'facultad_id.required' => 'Falta seleccionar la Facultad',
                'tipo_convenio_especifico_id.required' => 'Falta seleccionar el Tipo de Convenio Específico',
            ];
            $this->validate($request, [
                'facultad_id' => 'required',
                'tipo_convenio_especifico_id' => 'required',
            ], $messages);
            $convenio->facultad_id = $facultad_id;
            $convenio->tipo_convenio_especifico_id = $tipo_convenio_especifico_id;
            $convenio->save();
        }else {
            $convenio->save();
        }
        $result = 1;
        $message = 'El Convenio se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Convenio::findOrFail($id);
        $delete->delete();
        $message = 'El Convenio se eliminó correctamente';
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
        // convenio
        $convenio = Convenio::findOrFail($id);
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
                    $upload = $documento->move('archivos/documentos/convenios/', $filePath);
                    if($upload) {
                        $convenio->files()->create([
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
        $convenio_id = $request->convenio_id;
        $result = 1;
        $message = '';
        $delete = Convenio::findOrFail($convenio_id);
        $delete->files()->where('id', $file_id)->delete();
        $message = 'El documento se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
