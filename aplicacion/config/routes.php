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
$route['admin/concursos'] = 'Admin_Concursos';
$route['admin/concursos/(:any)'] = 'Admin_Concursos/$1';
$route['admin/concursos_foto'] = 'Admin_Concursos_Foto';
$route['admin/concursos_foto/(:any)'] = 'Admin_Concursos_Foto/$1';
$route['admin/cupones'] = 'Admin_Cupones';
$route['admin/cupones/(:any)'] = 'Admin_Cupones/$1';
$route['admin/corte_planes'] = 'Admin_CortePlanes';
$route['admin/corte_planes/(:any)'] = 'Admin_CortePlanes/$1';
$route['admin/corte_vendedores'] = 'Admin_CorteVendedores';
$route['admin/corte_vendedores/(:any)'] = 'Admin_CorteVendedores/$1';
$route['admin/premios'] = 'Admin_Premios';
$route['admin/premios/(:any)'] = 'Admin_Premios/$1';
$route['admin/slides'] = 'Admin_Slides';
$route['admin/slides/(:any)'] = 'Admin_Slides/$1';
$route['admin/carruseles'] = 'Admin_Carruseles';
$route['admin/carruseles/(:any)'] = 'Admin_Carruseles/$1';
$route['admin/sliders'] = 'Admin_Sliders';
$route['admin/sliders/(:any)'] = 'Admin_Sliders/$1';
$route['admin/publicaciones'] = 'Admin_Publicaciones';
$route['admin/publicaciones/(:any)'] = 'Admin_Publicaciones/$1';
$route['admin/planes'] = 'Admin_Planes';
$route['admin/planes/(:any)'] = 'Admin_Planes/$1';
$route['admin/divisas'] = 'Admin_Divisas';
$route['admin/divisas/(:any)'] = 'Admin_Divisas/$1';
$route['admin/paises'] = 'Admin_Paises';
$route['admin/paises/(:any)'] = 'Admin_Paises/$1';
$route['admin/estados'] = 'Admin_Estados';
$route['admin/estados/(:any)'] = 'Admin_Estados/$1';
$route['admin/municipios'] = 'Admin_Municipios';
$route['admin/municipios/(:any)'] = 'Admin_Municipios/$1';
$route['admin/lenguajes'] = 'Admin_Lenguajes';
$route['admin/lenguajes/(:any)'] = 'Admin_Lenguajes/$1';
$route['admin/transportistas'] = 'Admin_Transportistas';
$route['admin/transportistas/(:any)'] = 'Admin_Transportistas/$1';
$route['admin/transportistas_rangos'] = 'Admin_Transportistas_Rangos';
$route['admin/transportistas_rangos/(:any)'] = 'Admin_Transportistas_Rangos/$1';
$route['admin/transportistas_restricciones'] = 'Admin_Transportistas_Restricciones';
$route['admin/transportistas_restricciones/(:any)'] = 'Admin_Transportistas_Restricciones/$1';
$route['admin/disponibilidad'] = 'Admin_Transportistas';
$route['admin/disponibilidad/(:any)'] = 'Admin_Transportistas/$1';
$route['admin/usuarios'] = 'Admin_Usuarios';
$route['admin/usuarios/(:any)'] = 'Admin_Usuarios/$1';
$route['admin/direcciones'] = 'Admin_Direcciones';
$route['admin/direcciones/(:any)'] = 'Admin_Direcciones/$1';
$route['admin/puntos_registro'] = 'Admin_Puntos_Registro';
$route['admin/puntos_registro/(:any)'] = 'Admin_Puntos_Registro/$1';
$route['admin/tiendas'] = 'Admin_Tiendas';
$route['admin/tiendas/(:any)'] = 'Admin_Tiendas/$1';
$route['admin/servidores_mensajes'] = 'Admin_Conversaciones';
$route['admin/servidores_mensajes/(:any)'] = 'Admin_Conversaciones/$1';
$route['admin/perfiles_servicios'] = 'Admin_Perfiles_Servicios';
$route['admin/perfiles_servicios/(:any)'] = 'Admin_Perfiles_Servicios/$1';
$route['admin/categorias'] = 'Admin_Categorias';
$route['admin/categorias/(:any)'] = 'Admin_Categorias/$1';
$route['admin/servicios'] = 'Admin_Servicios';
$route['admin/servicios/(:any)'] = 'Admin_Servicios/$1';
$route['admin/guias'] = 'Admin_Guias';
$route['admin/guias/(:any)'] = 'Admin_Guias/$1';
$route['admin/pedidos'] = 'Admin_Pedidos';
$route['admin/pedidos/(:any)'] = 'Admin_Pedidos/$1';
$route['admin/productos'] = 'Admin_Productos';
$route['admin/productos/(:any)'] = 'Admin_Productos/$1';
$route['admin/productos_combinaciones'] = 'Admin_Productos_Combinaciones';
$route['admin/productos_combinaciones/(:any)'] = 'Admin_Productos_Combinaciones/$1';
$route['admin/productos_rangos_mayoreo'] = 'Admin_Productos_Rangos_Mayoreo';
$route['admin/productos_rangos_mayoreo/(:any)'] = 'Admin_Productos_Rangos_Mayoreo/$1';
$route['admin'] = 'Admin_Desktop';
$route['admin/(:any)'] = 'Admin_Desktop/$1';
// Rutas de Usuario
$route['usuario/registro_rapido'] = 'Usuario_Registros_Rapidos';
$route['usuario/registro_rapido/(:any)'] = 'Usuario_Registros_Rapidos/$1';
$route['usuario/datos_curiosos'] = 'Usuario_Datos_Curiosos';
$route['usuario/datos_curiosos/(:any)'] = 'Usuario_Datos_Curiosos/$1';
$route['usuario/planes'] = 'Usuario_Planes';
$route['usuario/planes/(:any)'] = 'Usuario_Planes/$1';
$route['usuario/favoritos'] = 'Usuario_Favoritos';
$route['usuario/favoritos'] = 'Usuario_Favoritos';
$route['usuario/direcciones'] = 'Usuario_Direcciones';
$route['usuario/direcciones/(:any)'] = 'Usuario_Direcciones/$1';
$route['usuario/mensajes'] = 'Usuario_Mensajes';
$route['usuario/mensajes/(:any)'] = 'Usuario_Mensajes/$1';
$route['usuario/pedidos'] = 'Usuario_Pedidos';
$route['usuario/pedidos/(:any)'] = 'Usuario_Pedidos/$1';
$route['usuario/ventas'] = 'Usuario_Ventas';
$route['usuario/ventas/(:any)'] = 'Usuario_Ventas/$1';
$route['usuario/servicios'] = 'Usuario_Servicios';
$route['usuario/servicios/(:any)'] = 'Usuario_Servicios/$1';
$route['usuario/servicios_traducciones'] = 'Usuario_Servicios_Traducciones';
$route['usuario/servicios_traducciones/(:any)'] = 'Usuario_Servicios_Traducciones/$1';
$route['usuario/productos'] = 'Usuario_Productos';
$route['usuario/productos/(:any)'] = 'Usuario_Productos/$1';
$route['usuario/productos_combinaciones'] = 'Usuario_Productos_Combinaciones';
$route['usuario/productos_combinaciones/(:any)'] = 'Usuario_Productos_Combinaciones/$1';
$route['usuario/productos_traducciones'] = 'Usuario_Productos_Traducciones';
$route['usuario/productos_traducciones/(:any)'] = 'Usuario_Productos_Traducciones/$1';
$route['usuario/tienda'] = 'Usuario_Tiendas';
$route['usuario/tienda/(:any)'] = 'Usuario_Tiendas/$1';
$route['usuario/perfil_servicios'] = 'Usuario_Perfiles_Servicios';
$route['usuario/perfil_servicios/(:any)'] = 'Usuario_Perfiles_Servicios/$1';
$route['usuario'] = 'Usuario_Perfil';
$route['usuario/(:any)'] = 'Usuario_Perfil/$1';
// Rutas de Ajax
$route['ajax/reordenar/(:any)'] = 'Ajax_Reordenar/$1';
$route['ajax/notificaciones/leidas'] = 'Ajax_Notificaciones/marcar_leidas';
$route['ajax/municipios'] = 'Ajax_Municipios';
$route['ajax/estados'] = 'Ajax_Estados';
$route['ajax/paises'] = 'Ajax_Paises';
$route['ajax/concurso/(:any)'] = 'Ajax_Concurso/$1';
$route['ajax/concurso'] = 'Ajax_Concurso';
$route['ajax/carrito'] = 'Ajax_Cargar_Carrito';
$route['ajax/carrito/(:any)'] = 'Ajax_Cargar_Carrito/$1';
$route['ajax/carrito_mayoreo'] = 'Ajax_Cargar_Carrito_Mayoreo';
$route['ajax/carrito_mayoreo/(:any)'] = 'Ajax_Cargar_Carrito_Mayoreo/$1';

// Rutas de Autenticacion
$route['login'] = 'Autenticacion';
$route['login/(:any)'] = 'Autenticacion/$1';

// Rutas de tienda

$route['planes'] = 'Tienda_Planes';
$route['planes/(:any)'] = 'Tienda_Planes/$1';
$route['premios'] = 'Tienda_Premios';
$route['premios/(:any)'] = 'Tienda_Premios/vista/$1';
$route['publicacion/(:any)'] = 'Tienda_Publicaciones/index/$1';
$route['concursos'] = 'Tienda_Concursos';
$route['concursos/(:any)'] = 'Tienda_Concursos/$1';
$route['concursos_foto'] = 'Tienda_Concursos_Foto';
$route['concursos_foto/(:any)'] = 'Tienda_Concursos_Foto/$1';
$route['datos_curiosos'] = 'Tienda_Datos_Curiosos';
$route['datos_curiosos/(:any)'] = 'Tienda_Datos_Curiosos/$1';
$route['test'] = 'Tienda_Test';
$route['test/(:any)'] = 'Tienda_Test/$1';
$route['guia'] = 'Tienda_Guia';
$route['divisas'] = 'Tienda_Divisas';
$route['divisas/(:any)'] = 'Tienda_Divisas/$1';
$route['lenguaje'] = 'Tienda_Lenguaje';
$route['lenguaje/(:any)'] = 'Tienda_Lenguaje/$1';
$route['categoria/servicios'] = 'Tienda_Categoria_Servicios';
$route['categoria/servicios/(:any)'] = 'Tienda_Categoria_Servicios/$1';
$route['categoria'] = 'Tienda_Categoria';
$route['categoria/(:any)'] = 'Tienda_Categoria/$1';
$route['producto'] = 'Tienda_Producto';
$route['producto/calificar'] = 'Tienda_Producto/calificar';
$route['producto/contacto'] = 'Tienda_Producto/contacto';
$route['producto/favorito'] = 'Tienda_Producto/favorito';
$route['producto/quitar_favorito'] = 'Tienda_Producto/quitar_favorito';
$route['producto/(:any)'] = 'Tienda_Producto';
$route['producto/(:any)/(:num)'] = 'Tienda_Producto';
$route['producto/vista_previa'] = 'Tienda_Producto/vista_previa';
$route['servicio'] = 'Tienda_Servicio';
$route['servicio/(:any)'] = 'Tienda_Servicio/$1';
$route['busqueda'] = 'Tienda_Busqueda';
$route['busqueda/(:any)'] = 'Tienda_Busqueda/$1';
$route['auto'] = 'Auto_hooks';
$route['auto/(:any)'] = 'Auto_hooks/$1';
$route['tienda-mayoreo'] = 'Tienda_Mayoreo';
$route['tienda-mayoreo/(:any)'] = 'Tienda_Mayoreo/$1';

// Proceso de Pago
//$route['proceso_pago_3'] = 'Proceso_Pago/paso3';
$route['invitado_pago_2'] = 'Proceso_Pago/invitado_paso2';
$route['compra_rapida'] = 'Proceso_Pago/compra_rapida';
$route['proceso_pago_4'] = 'Proceso_Pago/paso4';
$route['proceso_pago_3_banco'] = 'Proceso_Pago/paso3_banco';
$route['proceso_pago_3_oxxo'] = 'Proceso_Pago/paso3_oxxo';
$route['proceso_pago_3_paypal'] = 'Proceso_Pago/paso3_paypal';
$route['proceso_pago_3'] = 'Proceso_Pago/paso3';
$route['proceso_pago_2'] = 'Proceso_Pago/paso2';
$route['proceso_pago_1'] = 'Proceso_Pago/paso1';
$route['canjear_cupon'] = 'Proceso_Pago/canjear_cupon';
$route['eliminar_cupon'] = 'Proceso_Pago/eliminar_cupon';
$route['carrito'] = 'Proceso_Pago';
// Sobreescribir demo

$route['demo/(:any)/(:any)/(:any)'] = 'Tienda_Inicio';
$route['demo/(:any)/(:any)'] = 'Tienda_Inicio';
$route['demo/(:any)'] = 'Tienda_Inicio';
$route['demo'] = 'Tienda_Inicio';
$route['404'] = 'Tienda_Inicio/no_encontrada';
// Ruta de Mantenimiento
$route['mantenimiento'] = 'Mantenimiento';
