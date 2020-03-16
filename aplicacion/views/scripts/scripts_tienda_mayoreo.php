<script type="text/javascript">
/*
-----------------
Carrito
-----------------
*/
// Cargo el carrito por defecto
jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");

// Creo la función para gargar el pedido
function cargar_pedido(){
  var id_direccion = jQuery('#PedidoAjax').attr('data-id-direccion');
  var importe_productos_parcial = jQuery('#PedidoAjax').attr('data-importe-pedido-parcial');
  var importe_productos = jQuery('#PedidoAjax').attr('data-importe-pedido-total');
  var importe_envio_parcial = jQuery('#PedidoAjax').attr('data-importe-envio-parcial');
  var importe_envio_total = jQuery('#PedidoAjax').attr('data-importe-envio-total');
  var pedido_tienda = jQuery('#PedidoAjax').attr('data-pedido-tienda');
  var importe_descuento = jQuery('#PedidoAjax').attr('data-importe-descuento');
  var descripcion_descuento = jQuery('#PedidoAjax').attr('data-descripcion-descuento');
  var importe_total = jQuery('#PedidoAjax').attr('data-importe-total');
  var id_transportista_abanico = jQuery('#PedidoAjax').attr('data-id-transportista');
  var nombre_transportista_abanico = jQuery('#PedidoAjax').attr('data-nombre-transportista');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/carrito_mayoreo/pedido_final'); ?>",
    cache: false,
    dataType: "html",
    data: {
      IdDireccion: id_direccion,
      ImporteProductosParcial: importe_productos_parcial,
      ImporteProductosTotal: importe_productos,
      ImporteEnvioParcial: importe_envio_parcial,
      ImporteEnvioTotal: importe_envio_total,
      PedidoTienda: pedido_tienda,
      ImporteDescuento: importe_descuento,
      DescripcionDescuento: descripcion_descuento,
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

// Desactivo el boton de Comprar si no hay productos
jQuery( document ).ready( function(){
  var cantidad_productos = <?php echo count($_SESSION['carrito']['productos']); ?>;
  if (cantidad_productos==0){
    jQuery('.BotonEnLista').addClass('disabled');
    jQuery('.BotonEnLista').attr('aria-disabled','true');
  }
} );



jQuery('.BotonEnLista').on('click',function(e){
  // Leo las variables del botón
  var id_producto = jQuery(this).attr('data-id-producto');
  var nombre_producto = jQuery(this).attr('data-nombre-producto');
  var imagen_producto = jQuery(this).attr('data-imagen-producto');
  var peso_producto = jQuery(this).attr('data-peso-producto');
  var detalles_producto = jQuery(this).attr('data-detalles-producto');
  var sku = jQuery(this).attr('data-sku');
  var cantidad_max = jQuery(this).attr('data-cantidad-max');
  var divisa_default = jQuery(this).attr('data-divisa-default');
  var contra_entrega = jQuery(this).attr('data-contra-entrega');
  var envio_gratuito = jQuery(this).attr('data-envio-gratuito');
  var cantidad_producto = jQuery('#CantidadProducto').val();
  var precio_producto = jQuery(this).attr('data-precio-producto');
  var id_tienda = jQuery(this).attr('data-id-tienda');
  var nombre_tienda = jQuery(this).attr('data-nombre-tienda');

  //console.log(detalles_producto);

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito_mayoreo/cargar'); ?>",
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
      EnvioGratuito: envio_gratuito,
      CantidadProducto: cantidad_producto,
      PrecioProducto: precio_producto,
      IdTienda: id_tienda,
      NombreTienda: nombre_tienda
    },

    beforeSend: function(){
      jQuery('.CargarCarritoMayoreo').html('<div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div>');
    },
    success : function(texto)
     {
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");
          jQuery('.BotonEnLista').removeClass('disabled');
          jQuery('.BotonEnLista').attr('aria-disabled','false');
        jQuery('#ModalCarritoMayoreo').modal();
     }
  });
});
// Boton Incrementar
jQuery('.CargarCarritoMayoreo').on('click', '.boton-incrementar-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).attr('data-id-producto');
  var cantidad_max = jQuery(this).attr('data-cantidad-max');
  var detalles_producto = jQuery(this).attr('data-detalles-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito_mayoreo/incrementar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto,
      CantidadMaxima: cantidad_max
    },
    beforeSend: function(){
      jQuery('.CargarCarritoMayoreo').html('<div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div>');
    },
    success : function(texto)
     {
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");
        jQuery('.BotonEnLista').removeClass('disabled');
        jQuery('.BotonEnLista').attr('aria-disabled','false');
     }
  });
});
// Boton Disminuir
jQuery('.CargarCarritoMayoreo').on('click', '.boton-disminuir-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).attr('data-id-producto');
  var detalles_producto = jQuery(this).attr('data-detalles-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito_mayoreo/disminuir'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto
    },
    beforeSend: function(){
      jQuery('.CargarCarritoMayoreo').html('<div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div>');
    },
    success : function(texto)
     {
       jQuery.ajax({
         method: "GET",
         url: "<?php echo base_url('ajax/carrito_mayoreo/cantidad_productos_carrito'); ?>",
         dataType: "text",
         success : function(cantidad_productos_carrito)
          {
             if(cantidad_productos_carrito==0){
               jQuery('.BotonEnLista').addClass('disabled');
               jQuery('.BotonEnLista').attr('aria-disabled','true');
             }
          }
       });
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");
     }
  });
});
// Campo cantidad
jQuery('.CargarCarritoMayoreo').on('blur', '.form-cantidad-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).attr('data-id-producto');
  var cantidad_max = jQuery(this).attr('data-cantidad-max');
  var detalles_producto = jQuery(this).attr('data-detalles-producto');
  var cantidad_producto = jQuery(this).val();

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito_mayoreo/cantidad'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto,
      CantidadProducto: cantidad_producto,
      CantidadMaxima: cantidad_max
    },
    beforeSend: function(){
      jQuery('.CargarCarritoMayoreo').html('<div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div>');
    },
    success : function(texto)
     {
       jQuery.ajax({
         method: "GET",
         url: "<?php echo base_url('ajax/carrito_mayoreo/cantidad_productos_carrito'); ?>",
         dataType: "text",
         success : function(cantidad_productos_carrito)
          {
             if(cantidad_productos_carrito==0){
               jQuery('.BotonEnLista').addClass('disabled');
               jQuery('.BotonEnLista').attr('aria-disabled','true');
             }
          }
       });
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});
jQuery('.CargarCarritoMayoreo').on('click', '.boton-eliminar-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).attr('data-id-producto');
  var detalles_producto = jQuery(this).attr('data-detalles-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito_mayoreo/eliminar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      DetallesProducto: detalles_producto
    },
    beforeSend: function(){
      jQuery('.CargarCarritoMayoreo').html('<div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div>');
    },
    success : function(texto)
     {
       jQuery.ajax({
         method: "GET",
         url: "<?php echo base_url('ajax/carrito_mayoreo/cantidad_productos_carrito'); ?>",
         dataType: "text",
         success : function(cantidad_productos_carrito)
          {
             if(cantidad_productos_carrito==0){
               jQuery('.BotonEnLista').addClass('disabled');
               jQuery('.BotonEnLista').attr('aria-disabled','true');
             }
          }
       });
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});

// Vaciar Carrito
jQuery('#BotonVaciar').on('click',function(e){
  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito_mayoreo/vaciar'); ?>",
    success : function(texto)
     {
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo'); ?>");
        jQuery('.BotonEnLista').addClass('disabled');
        jQuery('.BotonEnLista').attr('aria-disabled','true');
        jQuery('#ModalCarrito').modal();
     }
  });
});

</script>
