<script>
// Popover
jQuery('[data-toggle="popover"]').popover();
// Editor Tinymce para todas las clases .Editor
/*
jQuery('.Editor').summernote({
    lang: 'es-ES', // default: 'en-US'
    height: 300,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    focus: true,                  // set focus to editable area after initializing summernote
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['misc',['fullscreen','codeview']]
    ]
  });
  */
  $(function(){
    $('.Editor').each(function(e){
        CKEDITOR.replace( this.id, { customConfig: '/jblog/ckeditor/config_Large.js' });
    });
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

// Controles checkboxes transportistas
// en cambio en PaisDireccion
jQuery('input[class*="control"]').on('change',function(e){
  var controla = jQuery(this).data('controla');
  if(this.checked) {
      jQuery('input[class*='+controla+']').prop('checked', true);
    }else{
      jQuery('input[class*='+controla+']').prop('checked', false);
    }
});

jQuery('input[class*="hijo"]').on('change',function(e){
  var padre = jQuery(this).data('padre');
    jQuery('input[name='+padre+']').prop('indeterminate', true);
});
// Previsualizar Imagenes
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#PrevisualizarImagen').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
function readURLMovil(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#PrevisualizarImagenMovil').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

jQuery('#ImagenServicio').change(function() {
  readURL(this);
});
jQuery('#ImagenProducto').change(function() {
  readURL(this);
});
jQuery('#ImagenPublicacion').change(function() {
  readURL(this);
});
jQuery('#ImagenSlide').change(function() {
  readURL(this);
});
jQuery('#ImagenPremio').change(function() {
  readURL(this);
});
jQuery('#ImagenSlideMovil').change(function() {
  readURLMovil(this);
});
jQuery('#ImagenTienda').change(function() {
  readURL(this);
});
jQuery('#ImagenPerfil').change(function() {
  readURL(this);
});

// Prevenir enviar formulario dos veces.

jQuery.validator.setDefaults({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});

  jQuery('button[type="submit"]').click(function(){
    var boton = jQuery(this);
    var formulario = jQuery(this).parents('form:first');

    formulario.validate({
      submitHandler: function(form) {
        boton.html("<i class='fa fa-spinner fa-pulse'></i> Por favor espere...");
        form.submit();
      }
    });
  });


</script>
