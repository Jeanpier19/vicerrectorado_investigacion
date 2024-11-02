import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
export default new VueRouter({
	routes : [
		{
			path: '/panel-administracion/principal',
			name: 'admin.principal',
			component: require('./components/Principal.vue').default
		},
		{
			path: '/panel-administracion/perfil',
			name: 'admin.perfil',
			component: require('./components/Perfil.vue').default
		},
		{
			path: '/panel-administracion/roles',
			name: 'admin.administracion.roles',
			component: require('./components/Roles.vue').default
		},
		{
			path: '/panel-administracion/usuarios',
			name: 'admin.administracion.users',
			component: require('./components/Users.vue').default
		},
		{
			path: '/panel-administracion/investigadores',
			name: 'admin.administracion.investigadores',
			component: require('./components/Investigadores.vue').default
		},
		{
			path: '/panel-administracion/solicitudes-creacion',
			name: 'admin.administracion.solicitudes-creacion',
			component: require('./components/SolicitudesCreacion.vue').default
		},
		{
			path: '/panel-administracion/facultades',
			name: 'admin.configuracion-base.facultades',
			component: require('./components/Facultades.vue').default
		},
		{
			path: '/panel-administracion/departamentos',
			name: 'admin.configuracion-base.departamentos',
			component: require('./components/Departamentos.vue').default
		},
		{
			path: '/panel-administracion/areas-investigacion',
			name: 'admin.configuracion-base.areas-investigacion',
			component: require('./components/Areas.vue').default
		},
		{
			path: '/panel-administracion/lineas-investigacion',
			name: 'admin.configuracion-base.lineas-investigacion',
			component: require('./components/Lineas.vue').default
		},
		{
			path: '/panel-administracion/sublineas-investigacion',
			name: 'admin.configuracion-base.sublineas-investigacion',
			component: require('./components/Sublineas.vue').default
		},
		{
			path: '/panel-administracion/etiquetas',
			name: 'admin.configuracion-base.etiquetas',
			component: require('./components/Etiquetas.vue').default
		},
		{
			path: '/panel-administracion/semestres',
			name: 'admin.configuracion-base.semestres',
			component: require('./components/Semestres.vue').default
		},
		{
			path: '/panel-administracion/tipos-institucion',
			name: 'admin.configuracion-base.tipos-institucion',
			component: require('./components/TiposInstitucion.vue').default
		},
		{
			path: '/panel-administracion/instituciones',
			name: 'admin.configuracion-base.instituciones',
			component: require('./components/Instituciones.vue').default
		},
		{
			path: '/panel-administracion/grupos-convenio-especifico',
			name: 'admin.configuracion-base.grupos-convenio-especifico',
			component: require('./components/GruposConvenioEspecifico.vue').default
		},
		{
			path: '/panel-administracion/tipos-convenio-especifico',
			name: 'admin.configuracion-base.tipos-convenio-especifico',
			component: require('./components/TiposConvenioEspecifico.vue').default
		},
		{
			path: '/panel-administracion/tipos-convocatoria',
			name: 'admin.configuracion-base.tipos-convocatoria',
			component: require('./components/TiposConvocatoria.vue').default
		},
		{
			path: '/panel-administracion/tipos-financiacion',
			name: 'admin.configuracion-base.tipos-financiacion',
			component: require('./components/TiposFinanciacion.vue').default
		},
		{
			path: '/panel-administracion/tipos-publicacion',
			name: 'admin.configuracion-base.tipos-publicacion',
			component: require('./components/TiposPublicacion.vue').default
		},
		{
			path: '/panel-administracion/descripcion',
			name: 'admin.configuracion-pagina-web.descripcion',
			component: require('./components/Descripcion.vue').default
		},
		{
			path: '/panel-administracion/banners',
			name: 'admin.configuracion-pagina-web.banners',
			component: require('./components/Banners.vue').default
		},
		{
			path: '/panel-administracion/noticias',
			name: 'admin.configuracion-pagina-web.noticias',
			component: require('./components/Noticias.vue').default
		},
		{
			path: '/panel-administracion/eventos',
			name: 'admin.configuracion-pagina-web.eventos',
			component: require('./components/Eventos.vue').default
		},
		{
			path: '/panel-administracion/convocatorias',
			name: 'admin.configuracion-pagina-web.convocatorias',
			component: require('./components/Convocatorias.vue').default
		},
		{
			path: '/panel-administracion/galerias',
			name: 'admin.configuracion-pagina-web.galerias',
			component: require('./components/Galerias.vue').default
		},
		{
			path: '/panel-administracion/videos',
			name: 'admin.configuracion-pagina-web.videos',
			component: require('./components/Videos.vue').default
		},
		{
			path: '/panel-administracion/proyectos-investigacion',
			name: 'admin.investigacion.proyectos-investigacion',
			component: require('./components/ProyectosInvestigacion.vue').default
		},
		{
			path: '/panel-administracion/proyectos-emprendimiento',
			name: 'admin.investigacion.proyectos-emprendimiento',
			component: require('./components/ProyectosEmprendimiento.vue').default
		},
		{
			path: '/panel-administracion/patentes',
			name: 'admin.investigacion.patentes',
			component: require('./components/Patentes.vue').default
		},
		{
			path: '/panel-administracion/publicaciones',
			name: 'admin.investigacion.publicaciones',
			component: require('./components/Publicaciones.vue').default
		},
		{
			path: '/panel-administracion/convenios',
			name: 'admin.investigacion.convenios',
			component: require('./components/Convenios.vue').default
		},
		{
			path: '/panel-administracion/movilidades',
			name: 'admin.investigacion.movilidades',
			component: require('./components/Movilidades.vue').default
		},
		{
			path: '/panel-administracion/circulos-investigacion',
			name: 'admin.investigacion.circulos-investigacion',
			component: require('./components/CirculosInvestigacion.vue').default
		},
		{
			path: '/panel-administracion/lider-miembros',
			name: 'lider.miembros',
			component: require('./components/LiderMiembros.vue').default
		},
		{
			path: '/panel-administracion/lider-proyectos-investigacion',
			name: 'lider.proyectos-investigacion',
			component: require('./components/LiderProyectosInvestigacion.vue').default
		},
		{
			path: '/panel-administracion/investigador-proyectos-investigacion',
			name: 'investigador.proyectos-investigacion',
			component: require('./components/InvestigadorProyectosInvestigacion.vue').default
		},
		{
			path: '/panel-administracion/investigador-publicacion-articulos',
			name: 'investigador.publicaciones.articulos',
			component: require('./components/InvestigadorPublicacionArticulos.vue').default
		},
		{
			path: '/panel-administracion/investigador-publicacion-capitulos-libros',
			name: 'investigador.publicaciones.capitulos-libros',
			component: require('./components/InvestigadorPublicacionCapitulosLibros.vue').default
		},
		{
			path: '/panel-administracion/investigador-publicacion-libros',
			name: 'investigador.publicaciones.libros',
			component: require('./components/InvestigadorPublicacionLibros.vue').default
		},
		{
			path: '/panel-administracion/*',
			name: 'admin.not-found',
			component: require('./components/NotFound.vue').default
		},
	],
	mode: 'history',
	linkActiveClass: 'active'
})