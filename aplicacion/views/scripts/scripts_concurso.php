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
      $( "#concurso_sortable" ).sortable();
     }
  });
}
cargar_concurso();

// Boton palabra_encontrada

jQuery('.palabra_encontrada').click(function(){
  var palabra = $(this).attr('data-palabra');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/concurso/palabra_encontrada'); ?>",
    cache: false,
    dataType: "html",
    data: {
      palabra: palabra
    },
    success : function(msg)
     {
       console.log(msg);
      cargar_concurso();
     }
  });
});


</script>
