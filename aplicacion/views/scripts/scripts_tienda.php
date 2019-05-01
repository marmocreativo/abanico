<script type="text/javascript">
/*
-----------------
Carrito
-----------------
*/
// Cargo el carrito por defecto
jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");

// Creo la función para gargar el pedido
function cargar_pedido(){
  var id_direccion = jQuery('#PedidoAjax').attr('data-id-direccion');
  var importe_productos_parcial = jQuery('#PedidoAjax').attr('data-importe-pedido-parcial');
  var importe_productos = jQuery('#PedidoAjax').attr('data-importe-pedido-total');
  var importe_envio_parcial = jQuery('#PedidoAjax').attr('data-importe-envio-parcial');
  var importe_envio_total = jQuery('#PedidoAjax').attr('data-importe-envio-total');
  var pedido_tienda = jQuery('#PedidoAjax').attr('data-pedido-tienda');
  var importe_total = jQuery('#PedidoAjax').attr('data-importe-total');
  var id_transportista_abanico = jQuery('#PedidoAjax').attr('data-id-transportista');
  var nombre_transportista_abanico = jQuery('#PedidoAjax').attr('data-nombre-transportista');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/carrito/pedido_final'); ?>",
    cache: false,
    dataType: "html",
    data: {
      IdDireccion: id_direccion,
      ImporteProductosParcial: importe_productos_parcial,
      ImporteProductosTotal: importe_productos,
      ImporteEnvioParcial: importe_envio_parcial,
      ImporteEnvioTotal: importe_envio_total,
      PedidoTienda: pedido_tienda,
      ImporteTotal: importe_total,
      IdTransportistaAbanico: id_transportista_abanico,
      NombreTransportistaAbanico: nombre_transportista_abanico
    },
    success : function(msg)
     {
      jQuery('#PedidoAjax').html(msg);
     }
  });
}

<?php if(uri_string()=='proceso_pago_3'|| uri_string()=='compra_rapida'){ ?>
// Cargo el pedido default
jQuery( document ).ready(function(){
  // Cargo los datos del Mejor pedido Abanico
  var id_transportista_abanico = jQuery('.selector-transportista-abanico:checked').attr('data-id-transportista-abanico');
  var nombre_transportista_abanico = jQuery('.selector-transportista-abanico:checked').attr('data-nombre-transportista-abanico');
  var importe_envio_parcial = jQuery('.selector-transportista-abanico:checked').attr('data-importe-envio-parcial');
  jQuery('.datos_tienda_abanico').removeAttr('data-id-transportista');
  jQuery('.datos_tienda_abanico').attr('data-id-transportista',id_transportista_abanico);
  jQuery('.datos_tienda_abanico').removeAttr('data-nombre-transportista');
  jQuery('.datos_tienda_abanico').attr('data-nombre-transportista',nombre_transportista_abanico);
  jQuery('.datos_tienda_abanico').removeAttr('data-importe-transportista');
  jQuery('.datos_tienda_abanico').attr('data-importe-transportista',importe_envio_parcial);
  var pedidos_tienda = {};

  jQuery('.datos_tienda').each(function(){
    var id_tienda = jQuery(this).attr('data-id-tienda');
    var nombre_tienda = jQuery(this).attr('data-nombre-tienda');
    var importe_producto = jQuery(this).attr('data-importe-productos');
    var id_transportista = jQuery(this).attr('data-id-transportista');
    var nombre_transportista = jQuery(this).attr('data-nombre-transportista');
    var importe_transportista = jQuery(this).attr('data-importe-transportista');
    var comision_venta = jQuery(this).attr('data-comision-venta');
    var comision_manejo = jQuery(this).attr('data-comision-manejo');
    pedidos_tienda[id_tienda] = {
      'id_tienda': id_tienda,
      'nombre_tienda': nombre_tienda,
      'importe_producto': importe_producto,
      'id_transportista': id_transportista,
      'nombre_transportista': nombre_transportista,
      'importe_transportista': importe_transportista,
      'comision_venta': comision_venta,
      'comision_manejo': comision_manejo,
    };
  });
  // Vuelvo a leer todas las tiendas y cargo los datos en el pedido
  var datos = unescape(encodeURIComponent(JSON.stringify(pedidos_tienda)));
  var encodedData = window.btoa(datos);
  jQuery('#PedidoAjax').attr('data-pedido-tienda',encodedData);
  cargar_pedido();
});


// Controles AJAX pedido
jQuery('.selector-transportista-abanico').on('click', function(){
  var id_tienda = jQuery(this).attr('data-id-tienda');
  var id_transportista_abanico = jQuery(this).attr('data-id-transportista-abanico');
  var nombre_transportista_abanico = jQuery(this).attr('data-nombre-transportista-abanico');
  var importe_envio_parcial= jQuery(this).attr('data-importe-envio-parcial');
  var importe_envio_tiendas= jQuery('#PedidoAjax').attr('data-importe-envio-tiendas');
  var importe_envio_total = parseFloat(importe_envio_parcial)+parseFloat(importe_envio_tiendas);
  var importe_pedido_total= jQuery('#PedidoAjax').attr('data-importe-pedido-total');
  var importe_total = parseFloat(importe_pedido_total)+parseFloat(importe_envio_total);
  // remuevo datos de tienda
  jQuery('.datos_tienda_abanico').removeAttr('data-id-transportista');
  jQuery('.datos_tienda_abanico').attr('data-id-transportista',id_transportista_abanico);
  jQuery('.datos_tienda_abanico').removeAttr('data-nombre-transportista');
  jQuery('.datos_tienda_abanico').attr('data-nombre-transportista',nombre_transportista_abanico);
  jQuery('.datos_tienda_abanico').removeAttr('data-importe-transportista');
  jQuery('.datos_tienda_abanico').attr('data-importe-transportista',importe_envio_parcial);
  //Leo los datos de las tiendas
  var pedidos_tienda = {};
  jQuery('.datos_tienda').each(function(){
    var id_tienda = jQuery(this).attr('data-id-tienda');
    var nombre_tienda = jQuery(this).attr('data-nombre-tienda');
    var importe_producto = jQuery(this).attr('data-importe-productos');
    var id_transportista = jQuery(this).attr('data-id-transportista');
    var nombre_transportista = jQuery(this).attr('data-nombre-transportista');
    var importe_transportista = jQuery(this).attr('data-importe-transportista');
    var comision_venta = jQuery(this).attr('data-comision-venta');
    var comision_manejo = jQuery(this).attr('data-comision-manejo');
    pedidos_tienda[id_tienda] = {
      'id_tienda': id_tienda,
      'nombre_tienda': nombre_tienda,
      'importe_producto': importe_producto,
      'id_transportista': id_transportista,
      'nombre_transportista': nombre_transportista,
      'importe_transportista': importe_transportista,
      'comision_venta': comision_venta,
      'comision_manejo': comision_manejo,
    };
  });
  // Vuelvo a leer todas las tiendas y cargo los datos en el pedido
  var datos = unescape(encodeURIComponent(JSON.stringify(pedidos_tienda)));
  var encodedData = window.btoa(datos);
  jQuery('#PedidoAjax').attr('data-pedido-tienda',encodedData);

  jQuery('#PedidoAjax').removeAttr('data-nombre-transportista');
  jQuery('#PedidoAjax').attr('data-nombre-transportista',nombre_transportista_abanico);
  // Importe envio parcial
  jQuery('#PedidoAjax').removeAttr('data-importe-envio-parcial');
  jQuery('#PedidoAjax').attr('data-importe-envio-parcial',importe_envio_parcial);
  // Importe envio total
  jQuery('#PedidoAjax').removeAttr('data-importe-envio-total');
  jQuery('#PedidoAjax').attr('data-importe-envio-total',importe_envio_total);
  // Importe total
  jQuery('#PedidoAjax').removeAttr('data-importe-total');
  jQuery('#PedidoAjax').attr('data-importe-total',importe_total);
  cargar_pedido();
});
// Radios Tiendas
jQuery('.selector-transportista-tienda').on('click', function(){
  var id_tienda = jQuery(this).attr('data-id-tienda');
  var id_transportista_tienda = jQuery(this).attr('data-id-transportista-tienda');
  var nombre_transportista_tienda = jQuery(this).attr('data-nombre-transportista-tienda');
  var importe_envio_tiendas = 0;
  var importe_envio_parcial= jQuery('#PedidoAjax').attr('data-importe-envio-parcial');
  var importe_pedido_total= jQuery('#PedidoAjax').attr('data-importe-pedido-total');
  jQuery('.selector-transportista-tienda').each(function(){
    if(jQuery(this).is(':checked')){
      var id_tienda = jQuery(this).attr('data-id-tienda');
      var importe_envio_tienda = jQuery(this).attr('data-importe-envio-tienda');
      jQuery('#tienda-'+id_tienda).removeAttr('data-importe-transportista');
      jQuery('#tienda-'+id_tienda).attr('data-importe-transportista',importe_envio_tienda);
      importe_envio_tiendas += parseFloat(importe_envio_tienda);
    }
  });
  var pedidos_tienda = {};

  jQuery('.datos_tienda').each(function(){
    var id_tienda = jQuery(this).attr('data-id-tienda');
    var nombre_tienda = jQuery(this).attr('data-nombre-tienda');
    var importe_producto = jQuery(this).attr('data-importe-productos');
    var id_transportista = jQuery(this).attr('data-id-transportista');
    var nombre_transportista = jQuery(this).attr('data-nombre-transportista');
    var importe_transportista = jQuery(this).attr('data-importe-transportista');
    var comision_venta = jQuery(this).attr('data-comision-venta');
    var comision_manejo = jQuery(this).attr('data-comision-manejo');
    pedidos_tienda[id_tienda] = {
      'id_tienda': id_tienda,
      'nombre_tienda': nombre_tienda,
      'importe_producto': importe_producto,
      'id_transportista': id_transportista,
      'nombre_transportista': nombre_transportista,
      'importe_transportista': importe_transportista,
      'comision_venta': comision_venta,
      'comision_manejo': comision_manejo,
    };
  });


  // Vuelvo a leer todas las tiendas y cargo los datos en el pedido
  var datos = unescape(encodeURIComponent(JSON.stringify(pedidos_tienda)));
  var encodedData = window.btoa(datos);
  jQuery('#PedidoAjax').attr('data-pedido-tienda',encodedData);

  // Suma
  var importe_envio_total = parseFloat(importe_envio_parcial)+parseFloat(importe_envio_tiendas);
  var importe_total = parseFloat(importe_pedido_total)+parseFloat(importe_envio_total);
  // Actualizo los data
  // Importe envio parcial
  jQuery('#PedidoAjax').removeAttr('data-importe-envio-tiendas');
  jQuery('#PedidoAjax').attr('data-importe-envio-tiendas',importe_envio_tiendas);
  // Importe envio total
  jQuery('#PedidoAjax').removeAttr('data-importe-envio-total');
  jQuery('#PedidoAjax').attr('data-importe-envio-total',importe_envio_total);
  // Importe total
  jQuery('#PedidoAjax').removeAttr('data-importe-total');
  jQuery('#PedidoAjax').attr('data-importe-total',importe_total);
  cargar_pedido();
});
// Selector de Pago contra entrega
jQuery('.selector-contra-entrega').on('change', function(){
var id_producto = jQuery(this).attr('data-id-producto');
var id_tienda = jQuery(this).attr('data-id-tienda');
var importe_envio_total= jQuery('#PedidoAjax').attr('data-importe-envio-total');
//console.log(importe_producto);

  if(jQuery(this).is(':checked')){
    var importe_producto = 0;
  }else{
    var importe_producto = jQuery(this).attr('data-importe-producto');
  }

  jQuery('#suma-producto-'+id_producto).attr('data-importe-producto',importe_producto);

  var suma_productos = 0;
  var suma_productos_tienda = 0;
    jQuery('.suma-producto').each(function(){
      var importe = jQuery(this).attr('data-importe-producto');
      var id_tienda_lista = jQuery(this).attr('data-id-tienda');
      if(id_tienda==id_tienda_lista){
        suma_productos_tienda += parseFloat(importe);
      }
      suma_productos += parseFloat(importe);
    });

  var importe_total = parseFloat(suma_productos)+parseFloat(importe_envio_total);
  // Importe pedido Total
  jQuery('#PedidoAjax').removeAttr('data-importe-pedido-total');
  jQuery('#PedidoAjax').attr('data-importe-pedido-total',suma_productos);
  jQuery('#tienda-'+id_tienda).attr('data-importe-productos',suma_productos_tienda);
  //
  // Importe Total
  jQuery('#PedidoAjax').removeAttr('data-importe-total');
  jQuery('#PedidoAjax').attr('data-importe-total',importe_total);
  var pedidos_tienda = {};

  jQuery('.datos_tienda').each(function(){
    var id_tienda = jQuery(this).attr('data-id-tienda');
    var nombre_tienda = jQuery(this).attr('data-nombre-tienda');
    var importe_producto = jQuery(this).attr('data-importe-productos');
    var id_transportista = jQuery(this).attr('data-id-transportista');
    var nombre_transportista = jQuery(this).attr('data-nombre-transportista');
    var importe_transportista = jQuery(this).attr('data-importe-transportista');
    var comision_venta = jQuery(this).attr('data-comision-venta');
    var comision_manejo = jQuery(this).attr('data-comision-manejo');
    pedidos_tienda[id_tienda] = {
      'id_tienda': id_tienda,
      'nombre_tienda': nombre_tienda,
      'importe_producto': importe_producto,
      'id_transportista': id_transportista,
      'nombre_transportista': nombre_transportista,
      'importe_transportista': importe_transportista,
      'comision_venta': comision_venta,
      'comision_manejo': comision_manejo,
    };
  });


  // Vuelvo a leer todas las tiendas y cargo los datos en el pedido
  var datos = unescape(encodeURIComponent(JSON.stringify(pedidos_tienda)));
  var encodedData = window.btoa(datos);
  jQuery('#PedidoAjax').attr('data-pedido-tienda',encodedData);
  cargar_pedido();
});

<?php } // / Se activa solo en el pedido_paso_3 ?>
// Desactivo el boton de Comprar si no hay productos
jQuery( document ).ready( function(){
  var cantidad_productos = <?php echo count($_SESSION['carrito']['productos']); ?>;
  if (cantidad_productos==0){
    jQuery('#BotonComprarAhora').addClass('disabled');
    jQuery('#BotonComprarAhora').attr('aria-disabled','true');
  }
} );


// Cargo el carrito
jQuery('#BotonComprar').on('click',function(e){
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var nombre_producto = jQuery(this).data('nombre-producto');
  var imagen_producto = jQuery(this).data('imagen-producto');
  var peso_producto = jQuery(this).data('peso-producto');
  var detalles_producto = jQuery(this).data('detalles-producto');
  var sku = jQuery(this).data('sku');
  var cantidad_max = jQuery(this).data('cantidad-max');
  var divisa_default = jQuery(this).data('divisa-default');
  var contra_entrega = jQuery(this).data('contra-entrega');
  var cantidad_producto = jQuery('#CantidadProducto').val();
  var precio_producto = jQuery(this).data('precio-producto');
  var id_tienda = jQuery(this).data('id-tienda');
  var nombre_tienda = jQuery(this).data('nombre-tienda');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/cargar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      NombreProducto: nombre_producto,
      ImagenProducto: imagen_producto,
      PesoProducto: peso_producto,
      DetallesProducto: detalles_producto,
      Sku: sku,
      CantidadMaxima: cantidad_max,
      DivisaDefault: divisa_default,
      ContraEntrega: contra_entrega,
      CantidadProducto: cantidad_producto,
      PrecioProducto: precio_producto,
      IdTienda: id_tienda,
      NombreTienda: nombre_tienda
    },
    success : function(texto)
     {
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
          jQuery('#BotonComprarAhora').removeClass('disabled');
          jQuery('#BotonComprarAhora').attr('aria-disabled','false');
        jQuery('#ModalCarrito').modal();
     }
  });
});
// Compra rápida
jQuery('#BotonCompraRapida').on('click',function(e){
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var nombre_producto = jQuery(this).data('nombre-producto');
  var imagen_producto = jQuery(this).data('imagen-producto');
  var peso_producto = jQuery(this).data('peso-producto');
  var detalles_producto = jQuery(this).data('detalles-producto');
  var sku = jQuery(this).data('sku');
  var cantidad_max = jQuery(this).data('cantidad-max');
  var divisa_default = jQuery(this).data('divisa-default');
  var contra_entrega = jQuery(this).data('contra-entrega');
  var cantidad_producto = jQuery('#CantidadProducto').val();
  var precio_producto = jQuery(this).data('precio-producto');
  var id_tienda = jQuery(this).data('id-tienda');
  var nombre_tienda = jQuery(this).data('nombre-tienda');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/cargar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      NombreProducto: nombre_producto,
      ImagenProducto: imagen_producto,
      PesoProducto: peso_producto,
      DetallesProducto: detalles_producto,
      Sku: sku,
      CantidadMaxima: cantidad_max,
      DivisaDefault: divisa_default,
      ContraEntrega: contra_entrega,
      CantidadProducto: cantidad_producto,
      PrecioProducto: precio_producto,
      IdTienda: id_tienda,
      NombreTienda: nombre_tienda
    },
    success : function(texto)
     {
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        window.location.href = "<?php echo base_url('compra_rapida'); ?>";
     }
  });
});
// Boton Incrementar
jQuery('.CargarCarrito').on('click', '.boton-incrementar-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var cantidad_max = jQuery(this).data('cantidad-max');
  var detalles_producto = jQuery(this).data('detalles-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/incrementar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto,
      CantidadMaxima: cantidad_max
    },
    success : function(texto)
     {
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#BotonComprarAhora').removeClass('disabled');
        jQuery('#BotonComprarAhora').attr('aria-disabled','false');
     }
  });
});
// Boton Disminuir
jQuery('.CargarCarrito').on('click', '.boton-disminuir-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var detalles_producto = jQuery(this).data('detalles-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/disminuir'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto
    },
    success : function(texto)
     {
       jQuery.ajax({
         method: "GET",
         url: "<?php echo base_url('ajax/carrito/cantidad_productos_carrito'); ?>",
         dataType: "text",
         success : function(cantidad_productos_carrito)
          {
             if(cantidad_productos_carrito==0){
               jQuery('#BotonComprarAhora').addClass('disabled');
               jQuery('#BotonComprarAhora').attr('aria-disabled','true');
             }
          }
       });
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
     }
  });
});
// Campo cantidad
jQuery('.CargarCarrito').on('blur', '.form-cantidad-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var cantidad_max = jQuery(this).data('cantidad-max');
  var detalles_producto = jQuery(this).data('detalles-producto');
  var cantidad_producto = jQuery(this).val();

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/cantidad'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto,
      CantidadProducto: cantidad_producto,
      CantidadMaxima: cantidad_max
    },
    success : function(texto)
     {
       jQuery.ajax({
         method: "GET",
         url: "<?php echo base_url('ajax/carrito/cantidad_productos_carrito'); ?>",
         dataType: "text",
         success : function(cantidad_productos_carrito)
          {
             if(cantidad_productos_carrito==0){
               jQuery('#BotonComprarAhora').addClass('disabled');
               jQuery('#BotonComprarAhora').attr('aria-disabled','true');
             }
          }
       });
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});
jQuery('.CargarCarrito').on('click', '.boton-eliminar-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var detalles_producto = jQuery(this).data('detalles-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/eliminar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto
    },
    success : function(texto)
     {
       jQuery.ajax({
         method: "GET",
         url: "<?php echo base_url('ajax/carrito/cantidad_productos_carrito'); ?>",
         dataType: "text",
         success : function(cantidad_productos_carrito)
          {
             if(cantidad_productos_carrito==0){
               jQuery('#BotonComprarAhora').addClass('disabled');
               jQuery('#BotonComprarAhora').attr('aria-disabled','true');
             }
          }
       });
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});

// Vaciar Carrito
jQuery('#BotonVaciar').on('click',function(e){
  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/vaciar'); ?>",
    success : function(texto)
     {
        jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#BotonComprarAhora').addClass('disabled');
        jQuery('#BotonComprarAhora').attr('aria-disabled','true');
        jQuery('#ModalCarrito').modal();
     }
  });
});
/*
-----------------
VARIACIONES
-----------------
*/
// Al cargar
var precio = $('.CombinacionProducto').find(':selected').data('precio-producto');
var detalles = $('.CombinacionProducto').find(':selected').data('detalles-producto');
var precio_visible = $('.CombinacionProducto').find(':selected').data('precio-visible-producto');
jQuery('#Precio_Producto').html(precio_visible);
jQuery('#BotonComprar').attr('data-precio-producto',precio);
jQuery('#BotonComprar').attr('data-detalles-producto',detalles);
jQuery('#BotonCompraRapida').attr('data-precio-producto',precio);
jQuery('#BotonCompraRapida').attr('data-detalles-producto',detalles);
// Al cambiar
jQuery('.CombinacionProducto').on('change',function(e){
  var precio = jQuery(this).find(':selected').data('precio-producto');
  var detalles = jQuery(this).find(':selected').data('detalles-producto');
  var precio_visible = jQuery(this).find(':selected').data('precio-visible-producto');
  jQuery('#Precio_Producto').html(precio_visible);
  jQuery('#BotonComprar').attr('data-precio-producto',precio);
  jQuery('#BotonComprar').attr('data-detalles-producto',detalles);
  jQuery('#BotonCompraRapida').attr('data-precio-producto',precio);
  jQuery('#BotonCompraRapida').attr('data-detalles-producto',detalles);

});
/*
-----------------
Botones del MENU
-----------------
*/
jQuery('#desplegar-menu-productos').click(function(){
  if(jQuery( "#menu-categorias-servicios" ).hasClass( "show" )){
    jQuery( "#menu-categorias-servicios" ).removeClass("show");
  }
});
jQuery('#desplegar-menu-servicios').click(function(){
  console.log('click en servicios');
  if(jQuery( "#menu-categorias" ).hasClass( "show" )){
    jQuery( "#menu-categorias" ).removeClass("show");
  }
});
/*
-----------------
GALERIA
-----------------
*/
jQuery(function(){
  jQuery('.imagen-galeria-producto').mouseover(function(){
    var nuevaImagen = jQuery(this).attr('src');
      jQuery('.visor-galeria-producto').attr('src',nuevaImagen);
  });
});
/*
-----------------
Calificación Estrellas
-----------------
*/
jQuery(function() {
 jQuery('.estrellas').starrr({
   emptyClass: 'far fa-star',
  change: function(e, value){
    jQuery('#EstrellasCalificacion').val(value)
   }
 });
});

   // CARRITO
 /*
 -----------------
Slider Productos
 -----------------
 */
 	jQuery( document ).ready(function( $ ) {
 		jQuery( '#my-slider' ).sliderPro({
      thumbnailsPosition: 'right',
      thumbnailPointer: true,
      buttons: false,
      width: '100%',
      fade: true,
      autoHeight: true,
    });
 	});
  /*
  -----------------
 Notificaciones
  -----------------
  */
  <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
  jQuery('#btnNotificaciones').on('click',function(e){
    // Envio la información por ajax
    jQuery.ajax({
      method: "POST",
      url: "<?php echo base_url('ajax/notificaciones/leidas'); ?>",
      dataType: "text",
      data: {
        IdUsuario: '<?php echo $_SESSION['usuario']['id']; ?>',
      },
      success : function(texto)
       {
          console.log(texto);
       }
    });
  });
  <?php } ?>

</script>
