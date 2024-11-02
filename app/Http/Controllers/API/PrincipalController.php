<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use App\Investigador;
use App\Facultad;
use App\Departamento;
use App\Area;
use App\Linea;
use App\Sublinea;
use App\Etiqueta;
use App\Semestre;
use App\TipoInstitucion;
use App\Institucion;
use App\GrupoConvenioEspecifico;
use App\TipoConvenioEspecifico;
use App\TipoConvocatoria;
use App\TipoFinanciacion;
use App\TipoPublicacion;
use App\Descripcion;
use App\Banner;
use App\Comunicado;
use App\Convocatoria;
use App\Galeria;
use App\Video;
use App\Proyecto;
// use App\Emprendimiento;
// use App\Patente;
use App\Publicacion;
use App\Convenio;
use App\Movilidad;
use App\Circulo;

class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index()
    {
    	$roles_count = Role::count();
    	$users_count = User::count();
    	$investigadores_count = Investigador::count();
    	$solicitudes_creacion_count = User::where('status', 2)
    		->count();
    	$facultades_count = Facultad::count();
    	$departamentos_count = Departamento::count();
    	$areas_investigacion_count = Area::count();
    	$lineas_investigacion_count = Linea::count();
    	$sublineas_investigacion_count = Sublinea::count();
    	$etiquetas_count = Etiqueta::count();
    	$semestres_count = Semestre::count();
    	$tipos_institucion_count = TipoInstitucion::count();
    	$instituciones_count = Institucion::count();
    	$grupos_convenio_especifico_count = GrupoConvenioEspecifico::count();
    	$tipos_convenio_especifico_count = TipoConvenioEspecifico::count();
    	$tipos_convocatoria_count = TipoConvocatoria::count();
    	$tipos_financiacion_count = TipoFinanciacion::count();
    	$tipos_publicacion_count = TipoPublicacion::count();
    	$descripcion_count = Descripcion::count();
    	$banners_count = Banner::count();
    	$noticias_count = Comunicado::where('tipo', 1)
    		->count();
    	$eventos_count = Comunicado::where('tipo', 2)
    		->count();
    	$convocatorias_count = Convocatoria::count();
    	$galerias_count = Galeria::count();
    	$videos_count = Video::count();
    	$proyectos_investigacion_count = Proyecto::where('tipo', 1)
    		->count();
    	// $proyectos_emprendimiento = Emprendimiento::count();
    	// $patentes_count = Patente::count();
    	$publicaciones_count = Publicacion::count();
    	$convenios_count = Convenio::count();
    	$movilidad_count = Movilidad::count();
    	$circulos_investigacion_count = Circulo::count();
        $response = [
            'roles_count' => $roles_count,
            'users_count' => $users_count,
            'investigadores_count' => $investigadores_count,
            'solicitudes_creacion_count' => $solicitudes_creacion_count,
            'facultades_count' => $facultades_count,
	    	'departamentos_count' => $departamentos_count,
	    	'areas_investigacion_count' => $areas_investigacion_count,
	    	'lineas_investigacion_count' => $lineas_investigacion_count,
	    	'sublineas_investigacion_count' => $sublineas_investigacion_count,
	    	'etiquetas_count' => $etiquetas_count,
	    	'semestres_count' => $semestres_count,
	    	'tipos_institucion_count' => $tipos_institucion_count,
	    	'instituciones_count' => $instituciones_count,
	    	'grupos_convenio_especifico_count' => $grupos_convenio_especifico_count,
	    	'tipos_convenio_especifico_count' => $tipos_convenio_especifico_count,
	    	'tipos_convocatoria_count' => $tipos_convocatoria_count,
	    	'tipos_financiacion_count' => $tipos_financiacion_count,
	    	'tipos_publicacion_count' => $tipos_publicacion_count,
	    	'descripcion_count' => $descripcion_count,
	    	'banners_count' => $banners_count,
	    	'noticias_count' => $noticias_count,
	    	'eventos_count' => $eventos_count,
	    	'convocatorias_count' => $convocatorias_count,
	    	'galerias_count' => $galerias_count,
	    	'videos_count' => $videos_count,
	    	'proyectos_investigacion_count' => $proyectos_investigacion_count,
	    	// 'proyectos_emprendimiento_count' => $proyectos_emprendimiento_count,
	    	// 'patentes_count' => $patentes_count,
	    	'publicaciones_count' => $publicaciones_count,
	    	'convenios_count' => $convenios_count,
	    	'movilidad_count' => $movilidad_count,
	    	'circulos_investigacion_count' => $circulos_investigacion_count,
        ];
        return response()->json($response);
    }
}
