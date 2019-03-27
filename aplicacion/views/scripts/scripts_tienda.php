<script type="text/javascript">
/*
-----------------
Carrito
-----------------
*/
// Cargo el carrito por defecto
jQuery('.CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");

// Cargo el pedido default
jQuery( document ).ready( function(){
  var id_direccion = jQuery('#PedidoAjax').data('id-direccion');
  var importe_productos_parcial = jQuery('#PedidoAjax').data('importe-pedido-parcial');
  var importe_productos = jQuery('#PedidoAjax').data('importe-pedido-total');
  var importe_envio_parcial = jQuery('#PedidoAjax').data('importe-envio-parcial');
  var importe_envio_total = jQuery('#PedidoAjax').data('importe-envio-total');
  var pedido_tienda = jQuery('#PedidoAjax').data('pedido-tienda');
  var importe_total = jQuery('#PedidoAjax').data('importe-total');
  var id_transportista_abanico = jQuery('#PedidoAjax').data('id-transportista');
  var nombre_transportista_abanico = jQuery('#PedidoAjax').data('nombre-transportista');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/carrito/pedido_final'); ?>",
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
});

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
jQuery('#BotonComprar').data('precio-producto',precio);
jQuery('#BotonComprar').data('detalles-producto',detalles);
// Al cambiar
jQuery('.CombinacionProducto').on('change',function(e){
  var precio = jQuery(this).find(':selected').data('precio-producto');
  var detalles = jQuery(this).find(':selected').data('detalles-producto');
  var precio_visible = jQuery(this).find(':selected').data('precio-visible-producto');
  jQuery('#Precio_Producto').html(precio_visible);
  jQuery('#BotonComprar').data('precio-producto',precio);
  jQuery('#BotonComprar').data('detalles-producto',detalles);

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
