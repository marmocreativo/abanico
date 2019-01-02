<script>
// Editor Tinymce para todas las clases .Editor
tinymce.init({
  selector:'.Editor'
  });
//
// Cargo Los Paises
jQuery.ajax({
  method: "GET",
  url: "<?php echo base_url('ajax/paises'); ?>",
  dataType: "json",
  success : function(texto)
   {
      var response = texto;
      response.forEach(function(fila) {
        jQuery('#PaisDireccion').append('<option value="'+fila['PAIS_NOMBRE']+'" data-id="'+fila['ID_PAIS']+'" >'+fila['PAIS_NOMBRE']+'</option>');
      });
      var valor_anterior =   jQuery('#PaisDireccion').data('valor-anterior');
      if(valor_anterior){
        if(jQuery("#PaisDireccion[value='"+valor_anterior+"']")){
            jQuery('#PaisDireccion').val(valor_anterior);
            jQuery( "#PaisDireccion" ).trigger( "change" );
        }
      }
   }
});
// en cambio en PaisDireccion
jQuery('#PaisDireccion').on('change',function(e){
  var pais = jQuery(this).find(':selected').data('id');
  var estados = jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/estados'); ?>",
    dataType: "json",
    data: { id : pais},
    success : function(texto)
     {
       var response = texto;
       jQuery('#EstadoDireccion').html('<option value="-" >Selecciona un Estado</option>');
       jQuery('#MunicipioDireccion').html('<option value="-" >Selecciona tu Municipio / Alcaldía</option>');
       response.forEach(function(fila) {
         jQuery('#EstadoDireccion').append('<option value="'+fila['ESTADO_NOMBRE']+'" >'+fila['ESTADO_NOMBRE']+'</option>');
      });
      var valor_anterior =   jQuery('#EstadoDireccion').data('valor-anterior');
      if(valor_anterior){
        if(jQuery("#EstadoDireccion[value='"+valor_anterior+"']")){
          jQuery('#EstadoDireccion').val(valor_anterior);
          jQuery( "#EstadoDireccion" ).trigger( "change" );
        }else{
          jQuery('#EstadoDireccion').val('-');
        }
      }
     }
  });
});

// en cambio en PaisDireccion
jQuery('#EstadoDireccion').on('change',function(e){
  var pais = jQuery('#PaisDireccion').find(':selected').data('id');
  var estado_seleccionado = jQuery(this).find(':selected').val();
  var municipios = jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/municipios'); ?>",
    dataType: "json",
    data: { id_pais : pais, estado : estado_seleccionado},
    success : function(texto)
     {
       var response = texto;
       jQuery('#MunicipioDireccion').html('<option value="-" >Selecciona tu Municipio / Alcaldía</option>');
       response.forEach(function(fila) {
         jQuery('#MunicipioDireccion').append('<option value="'+fila['MUNICIPIO_NOMBRE']+'" >'+fila['MUNICIPIO_NOMBRE']+'</option>');
      });
      var valor_anterior =  jQuery('#MunicipioDireccion').data('valor-anterior');
      if(valor_anterior){
        if(jQuery("#MunicipioDireccion[value='"+valor_anterior+"']")){
          jQuery('#MunicipioDireccion').val(valor_anterior);
        }
      }else{
        jQuery('#MunicipioDireccion').val('');
      }
     }
  });

});
</script>
