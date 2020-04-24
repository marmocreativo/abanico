<script type="text/javascript">
if ($('#Chart-linea').length > 0){
  var ctx = document.getElementById("Chart-linea");
  var Chartlinea = new Chart(ctx, {
      type: 'line',
      <?php
      $d = array();
      for($i = 0; $i < 30; $i++){
        $D[] = date("Y-m-d", strtotime('-'. $i .' days'));
      }
      $PEDIDOS = array();
      foreach($D as $d){
        $num_pedidos = $this->EstadisticasModel->conteo_pedidos_dia($d);
        $PEDIDOS[] = $num_pedidos;
      }
      ?>
      data: {
          labels: [ <?php $numItems = count($D); $i = 0; foreach($D as $d){ echo '"'.$d.'"'; if(++$i != $numItems) { echo ","; } } ?> ],
          datasets: [{
              label: '# of Votes',
              data: [ <?php $numItems = count($PEDIDOS); $i = 0; foreach($PEDIDOS as $pedidos){ echo '"'.$pedidos.'"'; if(++$i != $numItems) { echo ","; } } ?> ],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      }
  });
}

/*CARRITO MAYOREO*/
// Cargo el carrito por defecto
jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");

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



jQuery('.BotonEnLista').on('click',function(e){
  // Leo las variables del botón
  var id_producto = jQuery(this).attr('data-id-producto');
  var id_combinacion = jQuery(this).attr('data-id-combinacion');
  var nombre_producto = jQuery(this).attr('data-nombre-producto');
  var imagen_producto = jQuery(this).attr('data-imagen-producto');
  var peso_producto = jQuery(this).attr('data-peso-producto');
  var detalles_producto = jQuery(this).attr('data-detalles-producto');
  var sku = jQuery(this).attr('data-sku');
  var cantidad_max = jQuery(this).attr('data-cantidad-max');
  var divisa_default = jQuery(this).attr('data-divisa-default');
  var contra_entrega = jQuery(this).attr('data-contra-entrega');
  var envio_gratuito = jQuery(this).attr('data-envio-gratuito');
  var cantidad_producto = jQuery('.cantidad_producto[data-id-producto="'+id_producto+'"]').val();
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
      IdCombinacion: id_combinacion,
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
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");
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
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");
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
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");
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
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");
        jQuery('#ModalCarritoMayoreo').modal();
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
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");
        jQuery('#ModalCarritoMayoreo').modal();
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
        jQuery('.CargarCarritoMayoreo').load("<?php echo base_url('ajax/carrito_mayoreo/admin'); ?>");
        jQuery('.BotonEnLista').addClass('disabled');
        jQuery('.BotonEnLista').attr('aria-disabled','true');
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

$( ".CombinacionProducto" ).each(function( index ) {
  var id_producto = $(this).find(':selected').attr('data-id-producto');
  var id_combinacion = $(this).find(':selected').attr('data-id-combinacion');
  var precio = $(this).find(':selected').attr('data-precio-producto');
  var cantidad_max = $(this).find(':selected').attr('data-cantidad-max');
  var peso = $(this).find(':selected').attr('data-peso-producto');
  var detalles = $(this).find(':selected').attr('data-detalles-producto');
  var precio_visible = $(this).find(':selected').attr('data-precio-visible-producto');

  var imagen = $(this).find(':selected').attr('data-imagen-producto');
  if(imagen){
    var nuevaImagen = '<?php echo base_url('contenido/img/productos/completo/'); ?>'+imagen;
    jQuery('.imagen_producto[data-id-producto="'+id_producto+'"]').attr('src',nuevaImagen);
  }

  // Cambiar datos del boton
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-id-combinacion',id_combinacion);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-precio-producto',precio);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-cantidad-max',cantidad_max);
  jQuery('.cantidad_maxima_visible[data-id-producto="'+id_producto+'"]').html(cantidad_max);
  jQuery('.cantidad_maxima_visible[data-id-producto="'+id_producto+'"]').attr('max',cantidad_max);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-peso-producto',peso);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-detalles-producto',detalles);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-imagen-producto',nuevaImagen);

  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-precio-producto',precio);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-cantidad-max',cantidad_max);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-peso-producto',peso);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-detalles-producto',detalles);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-imagen-producto',nuevaImagen);

});



// Al cambiar
jQuery('.CombinacionProducto').on('change',function(e){
  var id_producto = jQuery(this).find(':selected').attr('data-id-producto');
  var id_combinacion = jQuery(this).find(':selected').attr('data-id-combinacion');
  var precio = jQuery(this).find(':selected').attr('data-precio-producto');
  var cantidad_max = jQuery(this).find(':selected').attr('data-cantidad-max');
  var peso = jQuery(this).find(':selected').attr('data-peso-producto');
  var detalles = jQuery(this).find(':selected').attr('data-detalles-producto');
  // Cambiar Imagen

  var imagen = jQuery(this).find(':selected').attr('data-imagen-producto');
  if(imagen){
    var nuevaImagen = '<?php echo base_url('contenido/img/productos/completo/'); ?>'+imagen;
    jQuery('.imagen_producto[data-id-producto="'+id_producto+'"]').attr('src',nuevaImagen);
  }
  // Cambiar datos del boton
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-id-combinacion',id_combinacion);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-precio-producto',precio);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-cantidad-max',cantidad_max);
  jQuery('.cantidad_producto[data-id-producto="'+id_producto+'"]').attr('max',cantidad_max);
  jQuery('.cantidad_maxima_visible[data-id-producto="'+id_producto+'"]').html(cantidad_max);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-peso-producto',peso);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-detalles-producto',detalles);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-imagen-producto',nuevaImagen);

  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-precio-producto',precio);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-cantidad-max',cantidad_max);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-peso-producto',peso);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-detalles-producto',detalles);
  jQuery('.BotonEnLista[data-id-producto="'+id_producto+'"]').attr('data-imagen-producto',nuevaImagen);

});

// Ocultar formulario Empresa
jQuery('.Comprador').on('change',function(e){
  var comprador = jQuery(this).val();
  if(comprador=='nueva'){
    jQuery('#colapsar_form_empresa').removeClass('collapse');
  }else{
    jQuery('#colapsar_form_empresa').addClass('collapse');
  }
});

// Ocultar formulario Fecha entrega
jQuery('#DejasProducto').on('change',function(e){
  var dejas_producto = jQuery(this).val();
  if(dejas_producto =='no'){
    jQuery('#fecha_entrega').removeClass('collapse');
  }else{
    jQuery('#fecha_entrega').addClass('collapse');
  }
});


</script>
