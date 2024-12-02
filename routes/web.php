<?php

use Illuminate\Support\Facades\Route;

// After

Route::get('/cooperacion/movilidadP','Web\PageController@movilidadP')->name('web.movilidadP');
Route::get('/axios/vue/cooperacion/movilidadPrincipal/get-graphic-items', 'Web\VueController@movilidad_get_graphic_items');
Route::get('/axios/vue/cooperacion/movilidadPrincipal/facultad_get_item','Web\VueController@facultad_get_item');
Route::get('/axios/vue/cooperacion/movilidadPrincipal/universidades_get_items','Web\VueController@universidades_get_items');
Route::get('/axios/vue/cooperacion/movilidadPrincipal/paises_get_items','Web\VueController@paises_get_items');

Route::get('/cooperacion/movilidadE','Web\PageController@movilidadE')->name('web.movilidadE');
Route::get('/axios/vue/cooperacion/movilidadExplorer/instituciones_get_items','Web\VueController@instituciones_get_items');


// Before

Route::get('/', 'Web\PageController@index')->name('web.index');
Route::get('/inicio', 'Web\PageController@index');
Route::get('/nosotros/mision-vision', 'Web\PageController@mision_vision')->name('web.mision-vision');
Route::get('/nosotros/organigrama', 'Web\PageController@organigrama')->name('web.organigrama');
Route::get('/nosostros/vicerrectorado-investigacion', 'Web\PageController@vicerrectorado_investigacion')->name('web.vicerrectorado-investigacion');
Route::get('/nosotros/publicaciones/{slug}', 'Web\PageController@publicaciones')->name('web.publicaciones');
Route::get('/nosotros/direcciones', 'Web\PageController@direcciones')->name('web.direcciones');
Route::get('/nosotros/unidades', 'Web\PageController@unidades')->name('web.unidades');
Route::get('/nosotros/centros-investigacion-experimentacion', 'Web\PageController@centros_investigacion_experimentacion')->name('web.centros-investigacion-experimentacion');
Route::get('/publicaciones-cientificas-indizadas', 'Web\PageController@publicaciones_cientificas_indizadas')->name('web.publicaciones-cientificas-indizadas');
Route::get('/publicaciones/{slug}', 'Web\PageController@publicaciones')->name('web.publicaciones');
Route::get('/libros', 'Web\PageController@libros')->name('web.libros');
Route::get('/publicaciones/libros/selasi', 'Web\PageController@selasi')->name('web.selasi');
Route::get('/boletin-investigacion', 'Web\PageController@boletin_investigacion')->name('web.boletin-investigacion');
//
Route::get('/cooperacion/convenios', 'Web\PageController@convenios')->name('web.convenios');
Route::get('/axios/vue/cooperacion/convenios/get-items', 'Web\VueController@convenios_get_items');
Route::get('/axios/vue/cooperacion/convenios/export', 'Web\VueController@convenios_export');
//
Route::get('/cooperacion/movilidad', 'Web\PageController@movilidad')->name('web.movilidad');
Route::get('/axios/vue/cooperacion/movilidad/get-items', 'Web\VueController@movilidad_get_items');
//
Route::get('/investigacion/areas-investigacion', 'Web\PageController@areas_investigacion')->name('web.areas-investigacion');
Route::get('/axios/vue/areas-investigacion/get-items', 'Web\VueController@areas_investigacion_get_items');
//
Route::get('/investigacion/grupos-investigacion', 'Web\PageController@grupos_investigacion')->name('web.grupos-investigacion');
Route::get('/axios/vue/grupos-investigacion/get-items', 'Web\VueController@grupos_investigacion_get_items');
//
//agregado el 30-07-2024
Route::get('/investigacion/semilleros-investigacion', 'Web\PageController@semilleros_investigacion')->name('web.semilleros-investigacion');

//



Route::get('/investigacion/circulos-investigacion', 'Web\PageController@circulos_investigacion')->name('web.circulos-investigacion');
Route::get('/investigacion/requisitos-deberes-derechos', 'Web\PageController@requisitos_deberes_derechos')->name('web.requisitos-deberes-derechos');
Route::get('/investigacion', 'Web\PageController@investigacion')->name('web.investigacion');
//
Route::get('/investigacion/investigadores', 'Web\PageController@investigadores')->name('web.investigadores');
Route::get('/axios/vue/investigacion/investigadores/get-items', 'Web\VueController@investigadores_get_items');
Route::post('/axios/vue/investigacion/investigadores/registrar-solicitud', 'Web\VueController@registrar_solicitud_investigador');
Route::get('/axios/vue/get-facultades', 'Web\VueController@get_facultades');
Route::get('/axios/vue/get-departamentos', 'Web\VueController@get_departamentos');
//
Route::get('/noticias', 'Web\PageController@noticias')->name('web.noticias');
Route::get('/noticia/{slug}', 'Web\PageController@noticia')->name('web.noticia');
Route::get('/eventos', 'Web\PageController@eventos')->name('web.eventos');
Route::get('/evento/{slug}', 'Web\PageController@evento')->name('web.evento');
Route::get('/convocatorias', 'Web\PageController@convocatorias')->name('web.convocatorias');
Route::get('/convocatoria/{slug}', 'Web\PageController@convocatoria')->name('web.convocatoria');

Route::get('/galerias', 'Web\PageController@galerias')->name('web.galerias');
Route::get('/videos', 'Web\PageController@videos')->name('web.videos');

Route::get('/eventos', 'Web\PageController@eventos')->name('web.eventos');
Route::get('/eventos/{titulo}', 'Web\PageController@evento')->name('web.evento');
Route::get('/investigacion/plataforma-unica-investigacion', 'Web\PageController@plataforma_unica_investigacion')->name('web.plataforma-unica-investigacion');
Route::get('/patentes', 'Web\PageController@patentes')->name('web.patentes');
//
Route::get('/investigacion/proyectos-investigacion', 'Web\PageController@proyectos_investigacion')->name('web.proyectos-investigacion');
Route::get('/axios/vue/proyectos-investigacion/get-items', 'Web\VueController@proyectos_investigacion_get_items');
//
Route::get('/subvenciones', 'Web\PageController@subvenciones')->name('web.subvenciones');

// Route::get('/proyectos-emprendimiento', 'Web\PageController@proyectos_emprendimiento')->name('web.proyectos-emprendimiento');

Route::get('/proyectos-emprendimiento', 'Web\PageController@proyectos_emprendimiento')->name('web.proyectos-emprendimiento');
Route::get('/axios/vue/proyectos-emprendimiento/get-items', 'Web\VueController@proyectos_emprendimiento_get_items');

Route::get('/becas-pasantias-cursos', 'Web\PageController@becas_pasantias_cursos')->name('web.becas-pasantias-cursos');
Route::get('/servicios-tecnologicos', 'Web\PageController@servicios_tecnologicos')->name('web.servicios-tecnologicos');

Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);

// Route::get('/panel-administracion/principal', 'API\PageController@index');
Route::get('/panel-administracion/{any}', 'API\PageController@index')->where('any', '.*');
