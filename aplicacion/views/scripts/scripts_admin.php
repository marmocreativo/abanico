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

// REORDENAR
function activar_reordenar(){
  if ( $( ".ui-sortable" ).length ) {

    $('.ui-sortable').sortable({
      scroll: true,
       helper: function(event, ui){
        var $clone =  $(ui).clone();
        $clone .css('position','absolute');
        return $clone.get(0);
        },
      start: function(){
        $(this).data("startingScrollTop",$(this).parent().scrollTop());
       },
        update: function (event, ui) {
        var objetos = $(this).sortable('serialize');
        var columna =  $(this).attr('data-columna');
        var tabla =  $(this).attr('data-tabla');
        if(columna!=null&&tabla!=null){
        // Llamada ajax
        var request = $.ajax({
            data: {
              objetos : objetos,
              tabla : tabla,
              columna : columna
            },
            type: 'GET',
            url: '<?php echo base_url('ajax/reordenar/'); ?>'+tabla,
            dataType: "html",
            success : function(respuesta)
             {
              var respuesta = respuesta;
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
            }
        });
      }

      }
    });
  }
}
activar_reordenar();
</script>
