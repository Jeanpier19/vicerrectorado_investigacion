<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Proyecto;
use App\Facultad;
use App\TipoFinanciacion;
use App\Area;
use App\Linea;
use App\Sublinea;
use App\Institucion;
use Validator;

class ProyectoEmprendimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }
    
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Proyecto::where('tipo', 10)
        ->with('facultad', 'sublinea.linea', 'tipo_financiacion', 'instituciones')
        ->where(function ($query) use ($search) {
            $query->where('clase', 'like', '%' . $search . '%')
            ->orWhere('titulo', 'like', '%' . $search . '%');
        })
        ->orderBy('main', 'desc')
        ->orderBy('anio', 'desc')
        ->paginate(10);
        $facultades = Facultad::where('active', 1)
        ->orderBy('main', 'desc')
        ->orderBy('nombre', 'asc')
        ->get();
        $tipos_financiacion = TipoFinanciacion::where('active', 1)
        ->orderBy('main', 'desc')
        ->orderBy('nombre', 'asc')
        ->get();
        $areas = Area::where('active', 1)
        ->orderBy('main', 'desc')
        ->orderBy('nombre', 'asc')
        ->get();
        $instituciones = Institucion::where('active', 1)
        ->orderBy('main', 'desc')
        ->orderBy('nombre', 'asc')
        ->get(['id', 'nombre']);
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
            'tipos_financiacion' => $tipos_financiacion,
            'areas' => $areas,
            'instituciones' => $instituciones,
        ];
        return response()->json($response);
    }

    
    public function get_lineas(Request $request) {
        $area_id = $request->area_id;
        $lineas = Linea::where('active', 1)
            ->where('area_id', $area_id)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $response = [
            'lineas' => $lineas,
        ];
        return response()->json($response);
    }

    public function get_sublineas(Request $request) {
        $linea_id = $request->linea_id;
        $sublineas = Sublinea::where('active', 1)
            ->where('linea_id', $linea_id)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $response = [
            'sublineas' => $sublineas,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // update
        $update = Proyecto::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Proyecto de Emprendimiento se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Proyecto de Emprendimiento se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $facultad_id = $request->facultad_id;
        $area_id = $request->area_id;
        $linea_id = $request->linea_id;
        $sublinea_id = $request->sublinea_id;
        $tipo_financiacion_id = $request->tipo_financiacion_id;
        $instituciones = $request->instituciones;
        $clase = $request->clase;
        $titulo = $request->titulo;
        $resumen = $request->resumen;
        $abstract = $request->abstract;
        $objetivos = $request->objetivos;
        $palabras_clave = $request->palabras_clave;
        $responsable = $request->responsable;
        $corresponsables = $request->corresponsables;
        $colaboradores = $request->colaboradores;
        $anio = $request->anio;
        $presupuesto = $request->presupuesto;
        $estado = $request->estado;
        $entregable = $request->entregable;
        $link = $request->link;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($resumen == null) {
          $resumen = '';
        }
        if($abstract == null) {
          $abstract = '';
        }
        if($objetivos == null) {
          $objetivos = '';
        }
        if($palabras_clave == null) {
          $palabras_clave = '';
        }
        if($corresponsables == null) {
          $corresponsables = '';
        }
        if($colaboradores == null) {
          $colaboradores = '';
        }
        if($link == null) {
          $link = '';
        }
        if($entregable == null) {
          $entregable = '';
        }
        // validation
        $messages = [
            'link.url' => 'El Enlace no es un link válido',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
            'tipo_financiacion_id.required' => 'Falta seleccionar el Tipo de Financiación',
            'area_id.required' => 'Falta seleccionar el Área de Investigación',
            'linea_id.required' => 'Falta seleccionar la Línea de Investigación',
            'sublinea_id.required' => 'Falta seleccionar la Sublínea de Investigación',
            'clase.required' => 'Falta seleccionar la Clase',
            'anio.required' => 'Falta ingresar el Año',
            'estado.required' => 'Falta seleccionar el Estado',
            'presupuesto.required' => 'Falta ingresar el Presupuesto',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El Título del Proyecto ya existe',
            'responsable.required' => 'Falta ingresar el Responsable',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
            'link' => 'nullable|url',
            'facultad_id' => 'required',
            'tipo_financiacion_id' => 'required',
            'area_id' => 'required',
            'linea_id' => 'required',
            'sublinea_id' => 'required',
            'clase' => 'required',
            'anio' => 'required',
            'estado' => 'required',
            'presupuesto' => 'required',
            'titulo' => 'required|unique:proyectos,titulo',
            'responsable' => 'required',
            'main' => 'required',
        ], $messages);
        // create proyecto
        $proyecto = new Proyecto;
        $proyecto->user_id = auth('api')->user()->id;
        $proyecto->facultad_id = $facultad_id;
        $proyecto->sublinea_id = $sublinea_id;
        $proyecto->tipo_financiacion_id = $tipo_financiacion_id;
        $proyecto->tipo = 10;
        $proyecto->clase = $clase;
        $proyecto->titulo = $titulo;
        $proyecto->resumen = $resumen;
        $proyecto->abstract = $abstract;
        $proyecto->objetivos = $objetivos;
        $proyecto->palabras_clave = $palabras_clave;
        $proyecto->responsable = $responsable;
        $proyecto->corresponsables = $corresponsables;
        $proyecto->colaboradores = $colaboradores;
        $proyecto->anio = $anio;
        $proyecto->presupuesto = $presupuesto;
        $proyecto->estado = $estado;
        $proyecto->entregable = $entregable;
        $proyecto->link = $link;
        $proyecto->main = $main;
        $proyecto->active = 1;
        $proyecto->save();
        $proyecto->instituciones()->sync($instituciones);
        $result = 1;
        $message = 'El Proyecto de Emprendimiento se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // proyecto
        $proyecto = Proyecto::findOrFail($id);
        // data from request
        $facultad_id = $request->facultad_id;
        $area_id = $request->area_id;
        $linea_id = $request->linea_id;
        $sublinea_id = $request->sublinea_id;
        $tipo_financiacion_id = $request->tipo_financiacion_id;
        $instituciones = $request->instituciones;
        $clase = $request->clase;
        $titulo = $request->titulo;
        $resumen = $request->resumen;
        $abstract = $request->abstract;
        $objetivos = $request->objetivos;
        $palabras_clave = $request->palabras_clave;
        $responsable = $request->responsable;
        $corresponsables = $request->corresponsables;
        $colaboradores = $request->colaboradores;
        $anio = $request->anio;
        $presupuesto = $request->presupuesto;
        $estado = $request->estado;
        $entregable = $request->entregable;
        $link = $request->link;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($resumen == null) {
          $resumen = '';
        }
        if($abstract == null) {
          $abstract = '';
        }
        if($objetivos == null) {
          $objetivos = '';
        }
        if($palabras_clave == null) {
          $palabras_clave = '';
        }
        if($corresponsables == null) {
          $corresponsables = '';
        }
        if($colaboradores == null) {
          $colaboradores = '';
        }
        if($link == null) {
          $link = '';
        }
        if($entregable == null) {
          $entregable = '';
        }
        // validation
        $messages = [
            'link.url' => 'El Enlace no es un link válido',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
            'tipo_financiacion_id.required' => 'Falta seleccionar el Tipo de Financiación',
            'area_id.required' => 'Falta seleccionar el Área de Investigación',
            'linea_id.required' => 'Falta seleccionar la Línea de Investigación',
            'sublinea_id.required' => 'Falta seleccionar la Sublínea de Investigación',
            'clase.required' => 'Falta seleccionar la Clase',
            'anio.required' => 'Falta ingresar el Año',
            'estado.required' => 'Falta seleccionar el Estado',
            'presupuesto.required' => 'Falta ingresar el Presupuesto',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El Título del Proyecto ya existe',
            'responsable.required' => 'Falta ingresar el Responsable',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
            'link' => 'nullable|url',
            'facultad_id' => 'required',
            'tipo_financiacion_id' => 'required',
            'area_id' => 'required',
            'linea_id' => 'required',
            'sublinea_id' => 'required',
            'clase' => 'required',
            'anio' => 'required',
            'estado' => 'required',
            'presupuesto' => 'required',
            'titulo' => 'required|unique:proyectos,titulo,' . $id,
            'responsable' => 'required',
            'main' => 'required',
        ], $messages);
        // create 
        $proyecto->user_id = auth('api')->user()->id;
        $proyecto->facultad_id = $facultad_id;
        $proyecto->sublinea_id = $sublinea_id;
        $proyecto->tipo_financiacion_id = $tipo_financiacion_id;
        $proyecto->tipo = 10;
        $proyecto->clase = $clase;
        $proyecto->titulo = $titulo;
        $proyecto->resumen = $resumen;
        $proyecto->abstract = $abstract;
        $proyecto->objetivos = $objetivos;
        $proyecto->palabras_clave = $palabras_clave;
        $proyecto->responsable = $responsable;
        $proyecto->corresponsables = $corresponsables;
        $proyecto->colaboradores = $colaboradores;
        $proyecto->anio = $anio;
        $proyecto->presupuesto = $presupuesto;
        $proyecto->estado = $estado;
        $proyecto->entregable = $entregable;
        $proyecto->link = $link;
        $proyecto->main = $main;
        $proyecto->active = 1;
        $proyecto->save();
        $proyecto->instituciones()->sync($instituciones);
        $result = 1;
        $message = 'El Proyecto de Emprendimiento se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Proyecto::findOrFail($id);
        // verify any relationship
        $delete->delete();
        $message = 'El Proyecto de Emprendimiento se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
