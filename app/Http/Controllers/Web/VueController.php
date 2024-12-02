<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\Area;
use App\Semestre;
use App\Movilidad;
use App\Facultad;
use App\Departamento;
use App\TipoFinanciacion;
use App\Investigador;
use App\Convenio;
use App\TipoConvenioEspecifico;
use App\File;
use App\Grupo;
// DB Raw
use Illuminate\Support\Facades\DB;
// exports
use App\Exports\ConveniosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Proyecto;

class VueController extends Controller
{
    public function __construct() {}

    // After
    public function instituciones_get_items(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $instituciones = DB::table('institucions')
            ->select('nombre', 'enlace', 'logos')
            ->paginate($perPage);

        return response()->json([
            'data' => $instituciones->items(),
            'total' => $instituciones->total(),
            'per_page' => $instituciones->perPage(),
            'current_page' => $instituciones->currentPage(),
            'last_page' => $instituciones->lastPage(),
        ]);
    }
    public function paises_get_items(Request $request)
    {
        $abreviatura = $request->input('abreviatura');
        $semestre_id = $request->input('semestre_id');
        $paises = DB::table('movilidads as mv')
            ->join('institucions as ins', 'mv.institucion_id', '=', 'ins.id')
            ->join('facultads as fc', 'mv.facultad_id', '=', 'fc.id')
            ->join('semestres as sems', 'mv.semestre_id', '=', 'sems.id')
            ->where('fc.abreviatura', $abreviatura)
            ->where('sems.id', $semestre_id)
            ->select('mv.pais', DB::raw('COUNT(fc.id) as count'))
            ->groupBy('mv.pais')
            ->get();
        $graphDataTres = [
            'paises' => $paises->map(function ($pais) {
                return [
                    'nombre' => $pais->pais,
                    'count' => $pais->count,
                ];
            }),
        ];

        return response()->json($graphDataTres);
    }
    public function universidades_get_items(Request $request)
    {
        $abreviatura = $request->input('abreviatura');
        $semestre_id = $request->input('semestre_id');
        $universidades = DB::table('movilidads as mv')
            ->join('institucions as ins', 'mv.institucion_id', '=', 'ins.id')
            ->join('facultads as fc', 'mv.facultad_id', '=', 'fc.id')
            ->join('semestres as sems', 'mv.semestre_id', '=', 'sems.id')
            ->select('ins.nombre', DB::raw('COUNT(fc.id) as count'))
            ->where('fc.abreviatura', $abreviatura)
            ->where('sems.id', $semestre_id)
            ->groupBy('ins.nombre')
            ->get();

        $graphDataDos = [
            'universidades' => $universidades->map(function ($universidad) {
                return [
                    'nombre' => $universidad->nombre,
                    'count' => $universidad->count,
                ];
            }),
        ];

        return response()->json($graphDataDos);
    }
    public function facultad_get_item(Request $request)
    {
        $nombreFacultad = Facultad::where('abreviatura', $request->facultad)->value('nombre');
        if (!$nombreFacultad) {
            return response()->json(['error' => 'Facultad no encontrada'], 404);
        }
        return response()->json($nombreFacultad);
    }

    public function movilidad_get_graphic_items(Request $request)
    {
        $tosearch_semestre = $request->tosearch_semestre;

        $semestres = Semestre::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('anio', 'desc')
            ->orderBy('periodo', 'desc')
            ->get();

        $query = DB::table('movilidads as mv')
            ->join('institucions as ins', 'mv.institucion_id', '=', 'ins.id')
            ->join('facultads as fc', 'mv.facultad_id', '=', 'fc.id')
            ->join('semestres as sems', 'mv.semestre_id', '=', 'sems.id')
            ->select('fc.abreviatura', DB::raw('COUNT(mv.pais) as total'))
            ->groupBy('fc.abreviatura')
            ->orderBy('total', 'desc');

        if ($tosearch_semestre) {
            $query->when($tosearch_semestre, function ($query, $tosearch_semestre) {
                return $query->where('sems.id', $tosearch_semestre);
            });
        }

        $viajes = $query->get();

        $graphData = [
            'semestres' => $semestres,
            'viajes' => $viajes->map(function ($viaje) {
                return [
                    'abreviatura' => $viaje->abreviatura,
                    'total' => $viaje->total,
                ];
            }),
        ];

        return response()->json($graphData);
    }

    // Before
    public function get_facultades()
    {
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $response = [
            'facultades' => $facultades,
        ];
        return response()->json($response);
    }
    public function get_departamentos(Request $request)
    {
        $facultad_id = $request->facultad_id;
        $departamentos = Departamento::where('active', 1)
            ->where('facultad_id', $facultad_id)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $response = [
            'departamentos' => $departamentos,
        ];
        return response()->json($response);
    }
    public function investigadores_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $items = Investigador::where('active', 1)
            ->with('departamento.facultad', 'user.persona', 'user.image', 'proyectos.tipo_financiacion', 'publicacion_articulos', 'publicacion_capitulos', 'publicacion_libros')
            ->where(function ($query) use ($search) {
                $query->where('grado', 'like', '%' . $search . '%');
                $query->orWhere('categoria', 'like', '%' . $search . '%');
            })
            ->orWhereHas('user.persona', function ($query) use ($search) {
                $query->where('nombres', 'like', '%' . $search . '%');
                $query->orWhere('apellidos', 'like', '%' . $search . '%');
                $query->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('fecha_inicio', 'asc')
            ->paginate($qty_toshow);
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
        ];
        return response()->json($response);
    }
    public function registrar_solicitud_investigador(Request $request)
    {
        // data fro request
        $dni = $request->dni;
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $genero = $request->genero;
        $celular = $request->celular;
        $email = $request->email;
        $grado = $request->grado;
        $categoria = $request->categoria;
        $departamento_id = $request->departamento_id;
        $cti = $request->cti;
        $orcid = $request->orcid;
        // response data
        $result = 1;
        $message = '';
        // null data
        if ($email == null) {
            $email = '';
        }
        // additional data not required
        $telefono = '';
        $direccion = '';
        $facebook = '';
        $twitter = '';
        $instagram = '';
        $linkedin = '';
        $github = '';
        $sitio_web = '';
        // 
        $hoja_vida = '';
        // validation
        $messages = [
            'dni.required' => 'Falta ingresar el N° de DNI',
            'dni.digits' => 'El N° de DNI debe ser un número de 8 dígitos',
            'dni.unique' => 'El DNI ya existe',
            'nombres.required' => 'Falta ingresar los nombres',
            'apellidos.required' => 'Falta ingresar los apellidos',
            'genero.required' => 'Falta seleccionar el género',
            'celular.required' => 'Falta ingresar el N° de Celular',
            'email.email' => 'El email no tiene un formato correcto',
            'grado.required' => 'Falta ingresar el Grado Académico',
            'categoria.required' => 'Falta seleccionar la Categoría',
            'departamento_id.required' => 'Falta seleccionar el Departamento Académico',
            'cti.required' => 'Falta ingresar el link a su CTI',
            'cti.url' => 'El enlace a su CTI no es un link válido',
            'orcid.required' => 'Falta ingresar su ID de ORCID',
        ];
        $this->validate($request, [
            'dni' => 'required|digits:8|unique:personas,dni',
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'email' => 'nullable|email',
            'grado' => 'required',
            'categoria' => 'required',
            'departamento_id' => 'required',
            'cti' => 'required|url',
            'orcid' => 'required',
        ], $messages);
        // create persona
        $persona = new Persona;
        $persona->dni = $dni;
        $persona->nombres = $nombres;
        $persona->apellidos = $apellidos;
        $persona->genero = $genero;
        $persona->email = $email;
        $persona->telefono = $telefono;
        $persona->celular = $celular;
        $persona->direccion = $direccion;
        $persona->facebook = $facebook;
        $persona->twitter = $twitter;
        $persona->instagram = $instagram;
        $persona->linkedin = $linkedin;
        $persona->github = $github;
        $persona->sitio_web = $sitio_web;
        $persona->save();
        // create user
        $user = new User;
        $user->persona_id = $persona->id;
        $user->username = $persona->dni;
        $user->password = bcrypt($persona->dni);
        $user->status = 2;
        $user->save();
        // create investigador
        $investigador = new Investigador;
        $investigador->departamento_id = $departamento_id;
        $investigador->user_id = $user->id;
        $investigador->hoja_vida = $hoja_vida;
        $investigador->grado = $grado;
        $investigador->categoria = $categoria;
        $investigador->cti = $cti;
        $investigador->orcid = $orcid;
        $investigador->main = 0;
        $investigador->active = 0;
        $investigador->save();
        $result = 1;
        $message = 'Su solicitud fue registrada correctamente, nos pondremos en contacto con usted a la brevedad a través del Celular/Email proporcionado(s)';
        return response()->json(["result" => $result, 'message' => $message]);
    }
    public function areas_investigacion_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $items = Area::where('active', 1)
            ->where(function ($query) use ($search) {
                $query->where('areas.nombre', 'like', '%' . $search . '%');
            })
            ->with('lineas.sublineas')
            ->orWhereHas('lineas', function ($query) use ($search) {
                $query->where('lineas.active', 1)
                    ->where('lineas.nombre', 'like', '%' . $search . '%');
            })
            ->orWhereHas('sublineas', function ($query) use ($search) {
                $query->where('sublineas.active', 1)
                    ->where('sublineas.nombre', 'like', '%' . $search . '%');
            })
            ->oldest()
            ->paginate($qty_toshow);
        $response = [
            'items' => $items,
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
        ];
        return response()->json($response);
    }
    public function grupos_investigacion_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $items = Grupo::with('linea')->where('activo', 1)
            ->where(function ($query) use ($search) {
                $query->where('grupos.nombre', 'like', '%' . $search . '%');
            })
            ->orWhereHas('linea', function ($query) use ($search) {
                $query->where('lineas.active', 1)
                    ->where('lineas.nombre', 'like', '%' . $search . '%');
            })
            ->oldest()
            ->paginate($qty_toshow);
        $response = [
            'items' => $items,
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
        ];
        return response()->json($response);
    }
    public function proyectos_investigacion_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $tosearch_anio_desde = $request->tosearch_anio_desde;
        $tosearch_anio_hasta = $request->tosearch_anio_hasta;
        $tosearch_facultad = json_decode($request->tosearch_facultad);
        $tosearch_tipo_financiacion = json_decode($request->tosearch_tipo_financiacion);
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $tipos_financiacion = TipoFinanciacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        if (count($tosearch_facultad) == 0) {
            for ($i = 0; $i < count($facultades); $i++) {
                $tosearch_facultad[$i] = $facultades[$i]->id;
            }
        }
        if (count($tosearch_tipo_financiacion) == 0) {
            for ($i = 0; $i < count($tipos_financiacion); $i++) {
                $tosearch_tipo_financiacion[$i] = $tipos_financiacion[$i]->id;
            }
        }
        $items = Proyecto::where('active', 1)
            ->where('tipo', 1)
            ->where('anio', '>=', $tosearch_anio_desde)
            ->where('anio', '<=', $tosearch_anio_hasta)
            ->whereIn('facultad_id', $tosearch_facultad)
            ->whereIn('tipo_financiacion_id', $tosearch_tipo_financiacion)
            ->where(function ($query) use ($search) {
                $query->where('anio', 'like', '%' . $search . '%');
                $query->orWhere('titulo', 'like', '%' . $search . '%');
                $query->orWhere('responsable', 'like', '%' . $search . '%');
                $query->orWhere('corresponsables', 'like', '%' . $search . '%');
                $query->orWhere('entregable', 'like', '%' . $search . '%');
            })
            ->with('sublinea.linea.area', 'facultad', 'tipo_financiacion')
            ->orderBy('main', 'desc')
            ->orderBy('anio', 'desc')
            ->paginate($qty_toshow);
        $response = [
            'items' => $items,
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'facultades' => $facultades,
            'tipos_financiacion' => $tipos_financiacion,
        ];
        return response()->json($response);
    }
    public function proyectos_emprendimiento_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $tosearch_anio_desde = $request->tosearch_anio_desde;
        $tosearch_anio_hasta = $request->tosearch_anio_hasta;
        $tosearch_facultad = json_decode($request->tosearch_facultad);
        $tosearch_tipo_financiacion = json_decode($request->tosearch_tipo_financiacion);
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        $tipos_financiacion = TipoFinanciacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        if (count($tosearch_facultad) == 0) {
            for ($i = 0; $i < count($facultades); $i++) {
                $tosearch_facultad[$i] = $facultades[$i]->id;
            }
        }
        if (count($tosearch_tipo_financiacion) == 0) {
            for ($i = 0; $i < count($tipos_financiacion); $i++) {
                $tosearch_tipo_financiacion[$i] = $tipos_financiacion[$i]->id;
            }
        }
        $items = Proyecto::where('active', 1)
            ->where('tipo', 10)
            ->where('anio', '>=', $tosearch_anio_desde)
            ->where('anio', '<=', $tosearch_anio_hasta)
            ->whereIn('facultad_id', $tosearch_facultad)
            ->whereIn('tipo_financiacion_id', $tosearch_tipo_financiacion)
            ->where(function ($query) use ($search) {
                $query->where('anio', 'like', '%' . $search . '%');
                $query->orWhere('titulo', 'like', '%' . $search . '%');
                $query->orWhere('responsable', 'like', '%' . $search . '%');
                $query->orWhere('corresponsables', 'like', '%' . $search . '%');
                $query->orWhere('entregable', 'like', '%' . $search . '%');
            })
            ->with('sublinea.linea.area', 'facultad', 'tipo_financiacion')
            ->orderBy('main', 'desc')
            ->orderBy('anio', 'desc')
            ->paginate($qty_toshow);
        $response = [
            'items' => $items,
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'facultades' => $facultades,
            'tipos_financiacion' => $tipos_financiacion,
        ];
        return response()->json($response);
    }
    public function convenios_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $tosearch_tipo = $request->tosearch_tipo;
        $tosearch_facultad = json_decode($request->tosearch_facultad);
        $tosearch_tipo_convenio_especifico = json_decode($request->tosearch_tipo_convenio_especifico);
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();

        $files = File::all();

        $tipos_convenio_especifico = TipoConvenioEspecifico::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        if (count($tosearch_facultad) == 0) {
            for ($i = 0; $i < count($facultades); $i++) {
                $tosearch_facultad[$i] = $facultades[$i]->id;
            }
        }
        if (count($tosearch_tipo_convenio_especifico) == 0) {
            for ($i = 0; $i < count($tipos_convenio_especifico); $i++) {
                $tosearch_tipo_convenio_especifico[$i] = $tipos_convenio_especifico[$i]->id;
            }
        }
        if ($tosearch_tipo == 1) {
            $items = Convenio::where('active', 1)
                ->where('tipo', 1)
                ->whereIn('facultad_id', $tosearch_facultad)
                ->whereIn('tipo_convenio_especifico_id', $tosearch_tipo_convenio_especifico)
                ->with('facultad', 'institucion', 'tipo_convenio_especifico', 'files')
                ->where(function ($query) use ($search) {
                    $query->where('ambito', 'like', '%' . $search . '%');
                    $query->orWhere('pais', 'like', '%' . $search . '%');
                    $query->orWhere('inicio', 'like', '%' . $search . '%');
                    $query->orWhere('finalizacion', 'like', '%' . $search . '%');
                    $query->orWhere('telefono', 'like', '%' . $search . '%');
                    $query->orWhere('resolucion', 'like', '%' . $search . '%');
                })
                ->orderBy('main', 'desc')
                ->latest('updated_at')
                ->paginate($qty_toshow);
        } elseif ($tosearch_tipo == 2) {
            $items = Convenio::where('active', 1)
                ->where('tipo', 2)
                ->with('institucion', 'files')
                ->where(function ($query) use ($search) {
                    $query->where('ambito', 'like', '%' . $search . '%');
                    $query->orWhere('pais', 'like', '%' . $search . '%');
                    $query->orWhere('inicio', 'like', '%' . $search . '%');
                    $query->orWhere('finalizacion', 'like', '%' . $search . '%');
                    $query->orWhere('telefono', 'like', '%' . $search . '%');
                    $query->orWhere('resolucion', 'like', '%' . $search . '%');
                })
                ->orderBy('main', 'desc')
                ->latest('updated_at')
                ->paginate($qty_toshow);
        } else {
            $items = [];
        }
        $response = [
            'items' => $items,
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'facultades' => $facultades,
            'tipos_convenio_especifico' => $tipos_convenio_especifico,
            'files' => $files
        ];
        return response()->json($response);
    }
    public function convenios_export(Request $request)
    {
        $type = $request->type;
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $tipo_convenio = $request->tipo_convenio;
        $tipo_convenio_especifico_id = $request->tipo_convenio_especifico_id;
        $facultad_id = $request->facultad_id;
        if ($type == 1) {
            return Excel::download(new ConveniosExport($search, $qty_toshow, $tipo_convenio, $tipo_convenio_especifico_id, $facultad_id), 'convenios.xlsx');
        } elseif ($type == 2) {
            return Excel::download(new ConveniosExport, 'convenios.pdf');
        }
    }
    public function movilidad_get_items(Request $request)
    {
        $search = $request->search;
        $qty_toshow = $request->qty_toshow;
        $tosearch_semestre = $request->tosearch_semestre;
        $tosearch_tipo = json_decode($request->tosearch_tipo);
        $tosearch_facultad = json_decode($request->tosearch_facultad);
        $semestres = Semestre::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('anio', 'desc')
            ->orderBy('periodo', 'desc')
            ->get();
        $facultades = Facultad::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        if (count($tosearch_tipo) == 0) {
            $tosearch_tipo = [1, 2];
        }
        if (count($tosearch_facultad) == 0) {
            for ($i = 0; $i < count($facultades); $i++) {
                $tosearch_facultad[$i] = $facultades[$i]->id;
            }
        }
        $items = Movilidad::where('active', 1)
            ->where('semestre_id', $tosearch_semestre)
            ->whereIn('tipo', $tosearch_tipo)
            ->whereIn('facultad_id', $tosearch_facultad)
            ->with('facultad', 'institucion', 'semestre')
            ->where(function ($query) use ($search) {
                $query->where('nombres', 'like', '%' . $search . '%');
                $query->orWhere('apellidos', 'like', '%' . $search . '%');
                $query->orWhere('modalidad', 'like', '%' . $search . '%');
                $query->orWhere('pais', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate($qty_toshow);
        $response = [
            'items' => $items,
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'semestres' => $semestres,
            'facultades' => $facultades,
        ];
        return response()->json($response);
    }
}
