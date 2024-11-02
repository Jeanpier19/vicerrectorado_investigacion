<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('principal', 'API\PrincipalController@index');

Route::get('get-facultades', 'API\FacultadController@get_facultades');
Route::get('get-departamentos', 'API\DepartamentoController@get_departamentos');

Route::apiResources(['role' => 'API\RoleController']);
Route::post('role/alta-baja/{active}/{id}', 'API\RoleController@enable_disable');

Route::apiResources(['user' => 'API\UserController']);
Route::post('user/alta-baja/{status}/{id}', 'API\UserController@enable_disable');
Route::post('user/restablecer-password/{id}', 'API\UserController@password_reset');
Route::get('user/profile/profile-data', 'API\UserController@get_profile_data');
Route::post('user/profile/profile-data', 'API\UserController@update_profile');
Route::post('user/profile/profile-data/update-profile-picture', 'API\UserController@update_profile_picture');

Route::apiResources(['investigador' => 'API\InvestigadorController']);
Route::post('investigador/alta-baja/{active}/{id}', 'API\InvestigadorController@enable_disable');
Route::get('investigador/search/user', 'API\InvestigadorController@search_user');

Route::apiResources(['investigador-renacyt' => 'API\InvestigadorRenacytController']);
Route::post('investigador-renacyt/alta-baja/{active}/{id}', 'API\InvestigadorRenacytController@enable_disable');
Route::get('investigador-renacyt/search/user', 'API\InvestigadorRenacytController@search_user');

Route::apiResources(['solicitud-creacion' => 'API\SolicitudCreacionController']);
Route::post('solicitud-creacion/verificar/{id}', 'API\SolicitudCreacionController@verify');

Route::apiResources(['facultad' => 'API\FacultadController']);
Route::post('facultad/alta-baja/{active}/{id}', 'API\FacultadController@enable_disable');

Route::apiResources(['departamento' => 'API\DepartamentoController']);
Route::post('departamento/alta-baja/{active}/{id}', 'API\DepartamentoController@enable_disable');

Route::apiResources(['area' => 'API\AreaController']);
Route::post('area/alta-baja/{active}/{id}', 'API\AreaController@enable_disable');

Route::apiResources(['linea' => 'API\LineaController']);
Route::post('linea/alta-baja/{active}/{id}', 'API\LineaController@enable_disable');

Route::apiResources(['sublinea' => 'API\SublineaController']);
Route::post('sublinea/alta-baja/{active}/{id}', 'API\SublineaController@enable_disable');

Route::apiResources(['grupo' => 'API\GrupoController']);
Route::post('grupo/alta-baja/{activo}/{id}', 'API\GrupoController@enable_disable');

Route::apiResources(['etiqueta' => 'API\EtiquetaController']);
Route::post('etiqueta/alta-baja/{active}/{id}', 'API\EtiquetaController@enable_disable');

Route::apiResources(['semestre' => 'API\SemestreController']);
Route::post('semestre/alta-baja/{active}/{id}', 'API\SemestreController@enable_disable');


Route::apiResources(['tipo-institucion' => 'API\TipoInstitucionController']);
Route::post('tipo-institucion/alta-baja/{active}/{id}', 'API\TipoInstitucionController@enable_disable');

Route::apiResources(['institucion' => 'API\InstitucionController']);
Route::post('institucion/alta-baja/{active}/{id}', 'API\InstitucionController@enable_disable');

Route::apiResources(['grupo-convenio-especifico' => 'API\GrupoConvenioEspecificoController']);
Route::post('grupo-convenio-especifico/alta-baja/{active}/{id}', 'API\GrupoConvenioEspecificoController@enable_disable');

Route::apiResources(['tipo-convenio-especifico' => 'API\TipoConvenioEspecificoController']);
Route::post('tipo-convenio-especifico/alta-baja/{active}/{id}', 'API\TipoConvenioEspecificoController@enable_disable');

Route::apiResources(['tipo-convocatoria' => 'API\TipoConvocatoriaController']);
Route::post('tipo-convocatoria/alta-baja/{active}/{id}', 'API\TipoConvocatoriaController@enable_disable');

Route::apiResources(['tipo-financiacion' => 'API\TipoFinanciacionController']);
Route::post('tipo-financiacion/alta-baja/{active}/{id}', 'API\TipoFinanciacionController@enable_disable');

Route::apiResources(['tipo-publicacion' => 'API\TipoPublicacionController']);
Route::post('tipo-publicacion/alta-baja/{active}/{id}', 'API\TipoPublicacionController@enable_disable');

Route::apiResources(['descripcion' => 'API\DescripcionController']);
Route::post('descripcion/alta-baja/{active}/{id}', 'API\DescripcionController@enable_disable');

Route::apiResources(['banner' => 'API\BannerController']);
Route::post('banner/alta-baja/{active}/{id}', 'API\BannerController@enable_disable');

Route::apiResources(['noticia' => 'API\NoticiaController']);
Route::post('noticia/alta-baja/{active}/{id}', 'API\NoticiaController@enable_disable');
Route::post('noticia/add-galeria', 'API\NoticiaController@add_galeria');
Route::post('noticia/delete-galeria', 'API\NoticiaController@delete_galeria');
Route::post('noticia/add-documento', 'API\NoticiaController@add_documento');
Route::post('noticia/delete-documento', 'API\NoticiaController@delete_documento');

Route::apiResources(['evento' => 'API\EventoController']);
Route::post('evento/alta-baja/{active}/{id}', 'API\EventoController@enable_disable');
Route::post('evento/add-galeria', 'API\EventoController@add_galeria');
Route::post('evento/delete-galeria', 'API\EventoController@delete_galeria');
Route::post('evento/add-documento', 'API\EventoController@add_documento');
Route::post('evento/delete-documento', 'API\EventoController@delete_documento');

Route::apiResources(['convocatoria' => 'API\ConvocatoriaController']);
Route::post('convocatoria/alta-baja/{active}/{id}', 'API\ConvocatoriaController@enable_disable');
Route::post('convocatoria/add-galeria', 'API\ConvocatoriaController@add_galeria');
Route::post('convocatoria/delete-galeria', 'API\ConvocatoriaController@delete_galeria');
Route::post('convocatoria/add-documento', 'API\ConvocatoriaController@add_documento');
Route::post('convocatoria/delete-documento', 'API\ConvocatoriaController@delete_documento');

Route::apiResources(['galeria' => 'API\GaleriaController']);
Route::post('galeria/alta-baja/{active}/{id}', 'API\GaleriaController@enable_disable');
Route::post('galeria/add-galeria', 'API\GaleriaController@add_galeria');
Route::post('galeria/delete-galeria', 'API\GaleriaController@delete_galeria');

Route::apiResources(['video' => 'API\VideoController']);
Route::post('video/alta-baja/{active}/{id}', 'API\VideoController@enable_disable');

Route::apiResources(['proyecto-investigacion' => 'API\ProyectoInvestigacionController']);
Route::post('proyecto-investigacion/alta-baja/{active}/{id}', 'API\ProyectoInvestigacionController@enable_disable');
Route::post('proyecto-investigacion/get-lineas', 'API\ProyectoInvestigacionController@get_lineas');
Route::post('proyecto-investigacion/get-sublineas', 'API\ProyectoInvestigacionController@get_sublineas');

Route::apiResources(['proyecto-emprendimiento' => 'API\ProyectoEmprendimientoController']);
Route::post('proyecto-emprendimiento/alta-baja/{active}/{id}', 'API\ProyectoEmprendimientoController@enable_disable');
Route::post('proyecto-emprendimiento/get-lineas', 'API\ProyectoEmprendimientoController@get_lineas');
Route::post('proyecto-emprendimiento/get-sublineas', 'API\ProyectoEmprendimientoController@get_sublineas');

Route::apiResources(['publicacion' => 'API\PublicacionController']);
Route::post('publicacion/alta-baja/{active}/{id}', 'API\PublicacionController@enable_disable');

Route::apiResources(['convenio' => 'API\ConvenioController']);
Route::post('convenio/alta-baja/{active}/{id}', 'API\ConvenioController@enable_disable');
Route::post('convenio/add-documento', 'API\ConvenioController@add_documento');
Route::post('convenio/delete-documento', 'API\ConvenioController@delete_documento');

Route::apiResources(['movilidad' => 'API\MovilidadController']);
Route::post('movilidad/alta-baja/{active}/{id}', 'API\MovilidadController@enable_disable');
Route::post('movilidad/add-documento', 'API\MovilidadController@add_documento');
Route::post('movilidad/delete-documento', 'API\MovilidadController@delete_documento');

