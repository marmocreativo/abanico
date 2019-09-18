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
      jQuery( "#concurso_sortable" ).sortable({
        placeholder: "col border border-warning p-3 text-center m-2",
        stop: function( event, ui ) {
          ui.item.removeClass('text-info');
          ui.item.removeClass('border');
          ui.item.removeClass('animated');
          ui.item.addClass('text-white bg-info');
        }
      });
     }
  });
}
cargar_concurso();

// Boton palabra_encontrada

jQuery('.palabra_encontrada').on('click',function(){
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
       //console.log(msg);
      cargar_concurso();
      $(this).hide();
     }
  });
  window.scrollTo(0, 0);
});
</script>
