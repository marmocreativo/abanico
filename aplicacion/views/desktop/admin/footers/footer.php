  <div class="pre-footer">
    <div class="barra-color barra-azul"></div>
    <div class="barra-color barra-rosa"></div>
    <div class="barra-color barra-amarillo"></div>
    <div class="barra-color barra-verde"></div>
    <div class="barra-color barra-morado"></div>
  </div>
  <div class="footer">

  </div>
  <div class="creditos">

  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/bootstrap.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=y3nn7mnqo19xsacsvznxqarsmohkoz42yat38khcnolpk6bf"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script>
    tinymce.init({
      selector:'.Editor'
      });
    $(window).on('load',function(){
      $('.borrar_confirmar').click(function (){

        Swal({
          title: '¿Estas seguro?',
          text: "Todos tus productos y servicios serán desactivados.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, estoy seguro!',
          cancelButtonText: 'Mejor no.',
        }).then((result) => {
          if (result.value) {
            var enlace = $(this).data('enlace');
            window.location=enlace;
          } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons(
              'Cancelado',
              'Tu cuenta está segura :)',
              'error'
            )
          }
        });
      });
    });
    </script>
    <!--<script src="assets/global/js/scripts_globales.js"></script>-->
  </body>
</html>
