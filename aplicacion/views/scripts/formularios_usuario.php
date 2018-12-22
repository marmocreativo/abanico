<script>
// Editor Tinymce para todas las clases .Editor
tinymce.init({
  selector:'.Editor'
  });
//
// Cargo Los Paises
$.ajax({
  method: "GET",
  url: "<?php echo base_url('ajax/paises'); ?>",
  dataType: "json",
  success : function(texto)
   {
      var response = texto;
      response.forEach(function(fila) {
        $('#PaisDireccion').append('<option value="'+fila['PAIS_NOMBRE']+'" data-id="'+fila['ID_PAIS']+'" >'+fila['PAIS_NOMBRE']+'</option>');
      });
      var valor_anterior =   $('#PaisDireccion').data('valor-anterior');
      if(valor_anterior){
        if($("#PaisDireccion[value='"+valor_anterior+"']")){
            $('#PaisDireccion').val(valor_anterior);
            $( "#PaisDireccion" ).trigger( "change" );
        }
      }
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
       $('#EstadoDireccion').html('<option value="-" >Selecciona un Estado</option>');
       $('#MunicipioDireccion').html('<option value="-" >Selecciona tu Municipio / Alcaldía</option>');
       response.forEach(function(fila) {
         $('#EstadoDireccion').append('<option value="'+fila['ESTADO_NOMBRE']+'" >'+fila['ESTADO_NOMBRE']+'</option>');
      });
      var valor_anterior =   $('#EstadoDireccion').data('valor-anterior');
      if(valor_anterior){
        if($("#EstadoDireccion[value='"+valor_anterior+"']")){
          $('#EstadoDireccion').val(valor_anterior);
          $( "#EstadoDireccion" ).trigger( "change" );
        }else{
          $('#EstadoDireccion').val('-');
        }
      }
     }
  });
});

// en cambio en PaisDireccion
$('#EstadoDireccion').on('change',function(e){
  var pais = $('#PaisDireccion').find(':selected').data('id');
  var estado_seleccionado = $(this).find(':selected').val();
  var municipios = $.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/municipios'); ?>",
    dataType: "json",
    data: { id_pais : pais, estado : estado_seleccionado},
    success : function(texto)
     {
       var response = texto;
       $('#MunicipioDireccion').html('<option value="-" >Selecciona tu Municipio / Alcaldía</option>');
       response.forEach(function(fila) {
         $('#MunicipioDireccion').append('<option value="'+fila['MUNICIPIO_NOMBRE']+'" >'+fila['MUNICIPIO_NOMBRE']+'</option>');
      });
      var valor_anterior =  $('#MunicipioDireccion').data('valor-anterior');
      if(valor_anterior){
        if($("#MunicipioDireccion[value='"+valor_anterior+"']")){
          $('#MunicipioDireccion').val(valor_anterior);
        }
      }else{
        $('#MunicipioDireccion').val('');
      }
     }
  });

  console.log(municipios);
});
</script>
