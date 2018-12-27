<script type="text/javascript">
/*
-----------------
Carrito
-----------------
*/
// Cargo el carrito por defecto
$('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");

// Cargo el carrito
$('#BotonComprar').on('click',function(e){
  // Leo las variables del botón
  var id_producto = $(this).data('id-producto');
  var nombre_producto = $(this).data('nombre-producto');
  var imagen_producto = $(this).data('imagen-producto');
  var peso_producto = $(this).data('peso-producto');
  var detalles_producto = $(this).data('detalles-producto');
  var cantidad_producto = $('#CantidadProducto').val();
  var precio_producto = $(this).data('precio-producto');
  var id_tienda = $(this).data('id-tienda');
  var nombre_tienda = $(this).data('nombre-tienda');

  // Envio la información por ajax
  $.ajax({
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
        $('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        $('#ModalCarrito').modal();
     }
  });
});
// Boton Incrementar
$('#CargarCarrito').on('click', '.boton-incrementar-carrito', function() {
  // Leo las variables del botón
  var id_producto = $(this).data('id-producto');

  // Envio la información por ajax
  $.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/incrementar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto
    },
    success : function(texto)
     {
       console.log(texto);
        $('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        $('#ModalCarrito').modal();
     }
  });
});
// Boton Disminuir
$('#CargarCarrito').on('click', '.boton-disminuir-carrito', function() {
  // Leo las variables del botón
  var id_producto = $(this).data('id-producto');

  // Envio la información por ajax
  $.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/disminuir'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto
    },
    success : function(texto)
     {
        $('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        $('#ModalCarrito').modal();
     }
  });
});
// Campo cantidad
$('#CargarCarrito').on('blur', '.form-cantidad-carrito', function() {
  // Leo las variables del botón
  var id_producto = $(this).data('id-producto');
  var cantidad_producto = $(this).val();

  // Envio la información por ajax
  $.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/cantidad'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto,
      CantidadProducto: cantidad_producto
    },
    success : function(texto)
     {
        $('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        $('#ModalCarrito').modal();
     }
  });
});
$('#CargarCarrito').on('click', '.boton-eliminar-carrito', function() {
  // Leo las variables del botón
  var id_producto = $(this).data('id-producto');

  // Envio la información por ajax
  $.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/eliminar'); ?>",
    dataType: "text",
    data: {
      IdProducto: id_producto
    },
    success : function(texto)
     {
       console.log(texto);
        $('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        $('#ModalCarrito').modal();
     }
  });
});

// Vaciar Carrito
$('#BotonVaciar').on('click',function(e){
  // Envio la información por ajax
  $.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/carrito/vaciar'); ?>",
    success : function(texto)
     {
        $('#CargarCarrito').load("<?php echo base_url('ajax/carrito'); ?>");
        $('#ModalCarrito').modal();
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

  $(function() {
      $('#EstrellasCalificacion').barrating({
        theme: 'fontawesome-stars'
      });
   });

   // CARRITO
</script>
