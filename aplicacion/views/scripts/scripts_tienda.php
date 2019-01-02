<script type="text/javascript">
/*
-----------------
Carrito
-----------------
*/
// Cargo el carrito por defecto
jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");

// Cargo el carrito
jQuery('#BotonComprar').on('click',function(e){
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var nombre_producto = jQuery(this).data('nombre-producto');
  var imagen_producto = jQuery(this).data('imagen-producto');
  var peso_producto = jQuery(this).data('peso-producto');
  var detalles_producto = jQuery(this).data('detalles-producto');
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
      CantidadProducto: cantidad_producto,
      PrecioProducto: precio_producto,
      IdTienda: id_tienda,
      NombreTienda: nombre_tienda
    },
    success : function(texto)
     {
        jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});
// Boton Incrementar
jQuery('#CargarCarrito').on('click', '.boton-incrementar-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/incrementar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto
    },
    success : function(texto)
     {
       console.log(texto);
        jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});
// Boton Disminuir
jQuery('#CargarCarrito').on('click', '.boton-disminuir-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/disminuir'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto
    },
    success : function(texto)
     {
        jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});
// Campo cantidad
jQuery('#CargarCarrito').on('blur', '.form-cantidad-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');
  var cantidad_producto = jQuery(this).val();

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/cantidad'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      CantidadProducto: cantidad_producto
    },
    success : function(texto)
     {
        jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});
jQuery('#CargarCarrito').on('click', '.boton-eliminar-carrito', function() {
  // Leo las variables del botón
  var id_producto = jQuery(this).data('id-producto');

  // Envio la información por ajax
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/eliminar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto
    },
    success : function(texto)
     {
       console.log(texto);
        jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
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
        jQuery('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        jQuery('#ModalCarrito').modal();
     }
  });
});



/*
-----------------
GALERIA
-----------------
*/
// select all thumbnails
  const galleryThumbnail = document.querySelectorAll(".thumbnails-list li");
  // select featured
  const galleryFeatured = document.querySelector(".product-gallery-featured img");

  // loop all items
  galleryThumbnail.forEach((item) => {
    item.addEventListener("mouseover", function () {
      let image = item.children[0].src;
      galleryFeatured.src = image;
    });
  });

  jQuery(function() {
      jQuery('#EstrellasCalificacion').barrating({
        theme: 'fontawesome-stars'
      });
   });

   // CARRITO
</script>
