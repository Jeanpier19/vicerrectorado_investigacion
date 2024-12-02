<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SolicitudDocenteStoreRequest;
use App\Descripcion;
use App\TipoPublicacion;
use App\Comunicado;
use App\Convocatoria;
use App\User;
use App\Persona;
use App\Facultad;
use App\Banner;
use App\Departamento;
use App\TipoConvenio;
use App\GrupoConvenioEspecifico;
use App\TipoConvenioEspecifico;
use App\Norma;
use App\Galeria;
use App\Video;
use App\Categoria;
use App\Boletin;
use App\Investigador;
use App\Publicacion;
use Mail;

class PageController extends Controller
{
    // Before
    public function index() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $banners = Banner::where('active', 1)
            ->with('image')
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->take(5)
            ->get();
        $noticias = Comunicado::where('active', 1)
            ->where('tipo', 1)
            ->with('images', 'etiquetas')
            ->orderBy('main', 'desc')
            ->orderBy('fecha', 'desc')
            ->take(3)
            ->get();
        $eventos = Comunicado::where('active', 1)
            ->where('tipo', 2)
            ->with('images', 'etiquetas')
            ->orderBy('main', 'desc')
            ->orderBy('fecha', 'desc')
            ->take(3)
            ->get();
        $galerias = Galeria::where('active', 1)
            ->with('images')
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->take(3)
            ->get();
        $videos = Video::where('active', 1)
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->take(3)
            ->get();
        // $tipos_publicacion_noticias = Categoria::where('active', 1)
        //     ->with('noticias', 'noticias.images')
        //     ->orderBy('main', 'desc')
        //     ->orderBy('nombre')
        //     ->get()->map(function ($query) {
        //         $query->setRelation('noticias',
        //             $query->noticias
        //                 ->sortByDesc('fecha')
        //                 ->take(3)
        //         );
        //         return $query;
        //     });
    	return view('web.index', compact('descripcion', 'tipos_publicacion', 'banners', 'noticias', 'eventos', 'galerias', 'videos'));
    }
    public function mision_vision() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $descripcion = Descripcion::latest()
            ->first();
    	return view('web.mision-vision', compact('descripcion', 'tipos_publicacion', 'descripcion'));
    }
    public function organigrama() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
    	return view('web.organigrama', compact('descripcion', 'tipos_publicacion', 'descripcion'));
    }
    public function vicerrectorado_investigacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
    	return view('web.vicerrectorado-investigacion', compact('descripcion', 'tipos_publicacion'));
    }
    public function direcciones() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
    	return view('web.direcciones', compact('descripcion', 'tipos_publicacion'));
    }
    public function unidades() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
    	return view('web.unidades', compact('descripcion', 'tipos_publicacion'));
    }
    public function centros_investigacion_experimentacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
    	return view('web.centros-investigacion-experimentacion', compact('descripcion', 'tipos_publicacion'));
    }
    public function noticias() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $noticias = Comunicado::where('active', 1)
            ->where('tipo', 1)
            ->with('images', 'files')
            ->orderBy('main', 'desc')
            ->orderBy('fecha', 'desc')
            ->paginate(6);
        return view('web.noticias', compact('descripcion', 'tipos_publicacion', 'noticias'));
    }
    public function noticia($slug) {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $noticia = Comunicado::where('slug', $slug)
            ->with('images', 'files')
            ->first();
        return view('web.noticia', compact('descripcion', 'tipos_publicacion', 'noticia'));
    }
    public function eventos() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $eventos = Comunicado::where('active', 1)
            ->where('tipo', 2)
            ->with('images', 'files')
            ->orderBy('main', 'desc')
            ->orderBy('fecha', 'desc')
            ->paginate(6);
        return view('web.eventos', compact('descripcion', 'tipos_publicacion', 'eventos'));
    }
    public function evento($slug) {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $evento = Comunicado::where('slug', $slug)
            ->with('images', 'files')
            ->first();
        return view('web.evento', compact('descripcion', 'tipos_publicacion', 'evento'));
    }
    public function convocatorias() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $convocatorias = Convocatoria::where('active', 1)
            ->with('tipo_convocatoria', 'images', 'files')
            ->orderBy('main', 'desc')
            ->orderBy('desde', 'desc')
            ->paginate(6);
        return view('web.convocatorias', compact('descripcion', 'tipos_publicacion', 'convocatorias'));
    }
    public function convocatoria($slug) {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $convocatoria = Convocatoria::where('slug', $slug)
            ->with('tipo_convocatoria', 'images', 'files')
            ->first();
        return view('web.convocatoria', compact('descripcion', 'tipos_publicacion', 'convocatoria'));
    }
    public function plataforma_unica_investigacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.plataforma-unica-investigacion', compact('descripcion', 'tipos_publicacion'));
    }
    public function publicaciones($tipo_publicacion_slug) {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $tipo_publicacion = TipoPublicacion::where('slug', $tipo_publicacion_slug)
            ->latest('updated_at')
            ->first();
        $publicaciones = Publicacion::where('tipo_publicacion_id', $tipo_publicacion->id)
            ->with('file', 'image', 'tipo_publicacion')
            ->latest('updated_at')
            ->paginate(10);
        return view('web.publicaciones', compact('descripcion', 'tipos_publicacion', 'tipo_publicacion', 'publicaciones'));
    }
    public function publicaciones_cientificas_indizadas() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.publicaciones-cientificas-indizadas', compact('descripcion', 'tipos_publicacion'));
    }
    public function selasi() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.selasi', compact('descripcion', 'tipos_publicacion'));
    }
    public function convenios() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.convenios', compact('descripcion', 'tipos_publicacion'));
    }
    public function movilidad() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.movilidad', compact('descripcion', 'tipos_publicacion'));
    }
    public function areas_investigacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.areas-investigacion', compact('descripcion', 'tipos_publicacion'));
    }
     public function grupos_investigacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.grupos-investigacion', compact('descripcion', 'tipos_publicacion'));
    }


    public function semilleros_investigacion() {//agregado el 30-07-2024
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get(); 
        //
        return view('web.semilleros-investigacion',compact('descripcion', 'tipos_publicacion'));
    }

    public function circulos_investigacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.circulos-investigacion', compact('descripcion', 'tipos_publicacion'));
    }
    public function requisitos_deberes_derechos() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.requisitos-deberes-derechos', compact('descripcion', 'tipos_publicacion'));
    }
    public function investigadores() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        // $investigadores = \DB::table('users')
        //     ->join('personas', 'users.persona_id', '=', 'personas.id')
        //     ->join('escuelas', 'personas.escuela_id', '=', 'escuelas.id')
        //     ->join('departamentos', 'escuelas.departamento_id', '=', 'departamentos.id')
        //     ->join('facultads', 'departamentos.facultad_id', '=', 'facultads.id')
        //   ->join('role_user', 'users.id', '=', 'role_user.user_id')
        //   ->join('roles', 'role_user.role_id', '=', 'roles.id')
        //   ->where('roles.id', 2)
        //   ->select('personas.nombres')
        //   ->select('personas.apellidos')
        //   ->select('personas.email')
        //   ->select('facultads.nombre as facultad')
        //   ->select('departamentos.nombre as departamento')
        //   ->select('escuelas.nombre as escuela')
        //   ->select('personas.sitio_web')
        //   ->select('personas.cti')
        //   ->select('personas.orcid')
        //   ->orderBy('users.created_at', 'DESC')
        //   ->paginate(10);

        // $investigadores = Investigador::where('estado', 1)
        //     ->with('escuela', 'escuela.departamento', 'escuela.departamento.facultad', 'user', 'user.persona')
        //     ->latest()
        //     ->paginate(10);
                  
        // $usuarios = User::where('status', true)
        //     ->with('image', 'roles', 'persona', 'persona', 'persona.escuela', 'persona.escuela.departamento')
        //     ->whereHas('roles', function($query) {
        //         $query->where('id', '2');
        //     })
        //     ->latest()
        //     ->paginate(6);
        // $investigadores = $usuarios;
        // $roles = [];
        // foreach($investigadores as $investigador) {
        //     array_push($roles, $investigador);
        // }
        // dd(in_array("1", $investigadores[0]->roles));
        // foreach($usuarios as $usuario) {
        //     foreach($usuario->roles as $role) {
        //         if($role->id == 2) {
        //             array_push($investigadores, $usuario);
        //         }
        //     }
        // }
        return view('web.investigadores', compact('descripcion', 'tipos_publicacion'));
    }
    public function get_escuelas(Request $request) {
        $escuelas = Escuela::orderBy('nombre')
            ->get();
        $response = [
            'escuelas' => $escuelas,
        ];
        return response()->json($response);
    }
    public function galerias() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $galerias = Galeria::where('active', 1)
            ->with('images')
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate(6);
        return view('web.galerias', compact('descripcion', 'tipos_publicacion', 'galerias'));
    }
    public function videos() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $videos = Video::where('active', 1)
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate(3);
        return view('web.videos', compact('descripcion', 'tipos_publicacion', 'videos'));
    }
    public function patentes() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.patentes', compact('descripcion', 'tipos_publicacion'));
    }
    public function proyectos_investigacion() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $facultades = Facultad::where('active', 1)
            ->orderBy('nombre')
            ->get();
        $departamentos = Departamento::where('active', 1)
            ->orderBy('nombre')
            ->get();
        return view('web.proyectos-investigacion', compact('descripcion', 'tipos_publicacion', 'facultades', 'departamentos'));
    }

     public function proyectos_emprendimiento() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        $facultades = Facultad::where('active', 1)
            ->orderBy('nombre')
            ->get();
        $departamentos = Departamento::where('active', 1)
            ->orderBy('nombre')
            ->get();
        return view('web.proyectos-emprendimiento', compact('descripcion', 'tipos_publicacion', 'facultades', 'departamentos'));
    }

    public function subvenciones() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.subvenciones', compact('descripcion', 'tipos_publicacion'));
    }
    /* public function emprendimientos() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.emprendimiento', compact('descripcion', 'tipos_publicacion'));
    } */
    public function becas_pasantias_cursos() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.becas-pasantias-cursos', compact('descripcion', 'tipos_publicacion'));
    }
    public function servicios_tecnologicos() {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('web.servicios-tecnologicos', compact('descripcion', 'tipos_publicacion'));
    }

    // After
    public function movilidadP() {
        return view('web.movilidadPrincipal');
    }

    public function movilidadE() {
        return view('web.movilidadExplorer');
    }
}
