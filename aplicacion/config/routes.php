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
$route['usuario'] = 'Usuario';
$route['categoria'] = 'Tienda_Categoria';
$route['producto'] = 'Tienda_Producto';
