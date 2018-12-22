<script>
// Editor Tinymce para todas las clases .Editor
tinymce.init({
  selector:'.Editor'
  });
//
// Cargo Los Paises
var paises = $.ajax({
  method: "GET",
  url: "<?php echo base_url('ajax/paises'); ?>",
  dataType: "json",
  success : function(texto)
   {
       var response = texto;
       console.log(response);
       response.forEach(function(fila) {
         $('#PaisDireccion').append('<option value="'+fila['PAIS_NOMBRE']+'" data-id="'+fila['ID_PAIS']+'" >'+fila['PAIS_NOMBRE']+'</option>');
      });
   }
});
// en cambio en PaisDireccion
$('#PaisDireccion').on('change',function(e){
  var pais = $(this).find(':selected').data('id');
  var estados = $.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/estados'); ?>",
    dataType: "json",
    data: { id : pais},
    success : function(texto)
     {
         var response = texto;
         $('#EstadoDireccion').html('<option data-id="" >Selecciona un Estado</option>');
         $('#MunicipioDireccion').html('<option data-id="" >Selecciona tu Municipio / Alcaldía</option>')
         response.forEach(function(fila) {
           $('#EstadoDireccion').append('<option value="'+fila['ESTADO_NOMBRE']+'" >'+fila['ESTADO_NOMBRE']+'</option>');
        });
     }
  });
});

// en cambio en PaisDireccion
$('#EstadoDireccion').on('change',function(e){
  var pais = $('#PaisDireccion').find(':selected').data('id');
  var estado = $(this).find(':selected').val();
  var municipios = $.ajax({
    method: "GET",
    url: "../ajax/municipios",
    dataType: "json",
    data: { id_pais : pais, estado : estado},
    success : function(texto)
     {
         var response = texto;
         console.log(response);
         $('#MunicipioDireccion').html('<option data-id="" >Selecciona tu Municipio / Alcaldía</option>')
         response.forEach(function(fila) {
           $('#MunicipioDireccion').append('<option value="'+fila['MUNICIPIO_NOMBRE']+'" >'+fila['MUNICIPIO_NOMBRE']+'</option>');
        });
     }
  });
});
</script>
