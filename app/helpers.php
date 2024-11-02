<?php
function menu_open($path) {
	return request()->is($path) ? 'menu-open' : '';
}
function active($path) {
	return request()->is($path) ? 'active' : '';
}
function limit_string($cadena, $limite, $sufijo){
	if(strlen($cadena) > $limite){
		return substr($cadena, 0, $limite) . $sufijo;
	}
	return $cadena;
}