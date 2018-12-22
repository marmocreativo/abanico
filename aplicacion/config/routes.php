<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| RUTAS RESERVADAS DEL SISTEMA
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'Tienda_Inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| RUTAS APLICACIÓN ABANICO
| -------------------------------------------------------------------------
*/

// Rutas de Administrador

$route['admin/divisas'] = 'Admin_Divisas';
$route['admin/divisas/([a-z]+)'] = 'Admin_Divisas/$1';
$route['admin/paises'] = 'Admin_Paises';
$route['admin/paises/([a-z]+)'] = 'Admin_Paises/$1';
$route['admin/estados'] = 'Admin_Estados';
$route['admin/estados/([a-z]+)'] = 'Admin_Estados/$1';
$route['admin/lenguajes'] = 'Admin_Lenguajes';
$route['admin/lenguajes/([a-z]+)'] = 'Admin_Lenguajes/$1';
$route['admin/usuarios'] = 'Admin_Usuarios';
$route['admin/usuarios/([a-z]+)'] = 'Admin_Usuarios/$1';
$route['admin/direcciones'] = 'Admin_Direcciones';
$route['admin/direcciones/([a-z]+)'] = 'Admin_Direcciones/$1';
$route['admin/tiendas'] = 'Admin_Tiendas';
$route['admin/tiendas/([a-z]+)'] = 'Admin_Tiendas/$1';
$route['admin/categorias'] = 'Admin_Categorias';
$route['admin/categorias/([a-z]+)'] = 'Admin_Categorias/$1';
$route['admin/productos'] = 'Admin_Productos';
$route['admin/productos/(:any)'] = 'Admin_Productos/$1';
$route['admin'] = 'Admin_Desktop';
// Rutas de Usuario

$route['usuario/direcciones'] = 'Usuario_Direcciones';
$route['usuario/direcciones/(:any)'] = 'Usuario_Direcciones/$1';
$route['usuario/productos'] = 'Usuario_Productos';
$route['usuario/productos/(:any)'] = 'Usuario_Productos/$1';
$route['usuario/tienda'] = 'Usuario_Tiendas';
$route['usuario/tienda/(:any)'] = 'Usuario_Tiendas/$1';
$route['usuario'] = 'Usuario_Perfil';
$route['usuario/([a-z]+)'] = 'Usuario_Perfil/$1';
// Rutas de Ajax
$route['ajax/municipios'] = 'Ajax_Municipios';
$route['ajax/estados'] = 'Ajax_Estados';
$route['ajax/paises'] = 'Ajax_Paises';
// Rutas de Autenticacion
$route['login'] = 'Autenticacion';
$route['login/([a-z]+)'] = 'Autenticacion/$1';
// Rutas de tienda
$route['categoria'] = 'Tienda_Categoria';
$route['categoria/(:any)'] = 'Tienda_Categoria/$1';
$route['producto'] = 'Tienda_Producto';
// Ruta de Mantenimiento
$route['mantenimiento'] = 'Mantenimiento';
