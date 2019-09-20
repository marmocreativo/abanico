<script type="text/javascript">

function cargar_concurso(){
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/concurso'); ?>",
    cache: false,
    dataType: "html",
    data: {
    },
    success : function(msg)
     {
      jQuery('#contenedor_concurso').html(msg);
      var cantidad_palabras = jQuery( "#concurso_sortable" ).attr('data-numero-palabras');
      jQuery( "#concurso_sortable" ).sortable({
        placeholder: "col border border-warning p-3 text-center m-2",
        stop: function( event, ui ) {
          var incorrectas = cantidad_palabras;
          jQuery('.palabra_concurso').each(function(index){
            jQuery(this).removeClass('animated');

            if(jQuery(this).attr('data-orden')==index){
              // Si es correcto
              jQuery(this).removeClass('incorrecto');
              jQuery(this).removeClass('text-info');
              jQuery(this).addClass('border-info text-white bg-info correcto');
                incorrectas --;
            }else{
              // Si es incorrecto
              jQuery(this).removeClass('correcto');
              jQuery(this).removeClass('text-white');
              jQuery(this).removeClass('bg-info');
              jQuery(this).addClass('border-info text-info incorrecto');
            }
          });
          // Si todas las palabras están en orden
          console.log(incorrectas);
          if(incorrectas==0){
            jQuery.ajax({
              method: "GET",
              url: "<?php echo base_url('ajax/concurso/frase_completa'); ?>",
              cache: false,
              dataType: "html",
              success : function(msg)
               {
                 cargar_concurso();
               }
            });
          }

        }
      });
     }
  });
}
cargar_concurso();

// Boton palabra_encontrada

jQuery('.palabra_encontrada').on('click',function(){
  var palabra = $(this).attr('data-palabra');
  var id = $(this).attr('data-id');
  var elemento = $(this);
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/concurso/palabra_encontrada'); ?>",
    cache: false,
    dataType: "html",
    data: {
      palabra: palabra,
      id: id
    },
    success : function(msg)
     {
       //console.log(msg);
      cargar_concurso();
      elemento.hide();
     }
  });
  window.scrollTo(0, 0);
});
</script>
