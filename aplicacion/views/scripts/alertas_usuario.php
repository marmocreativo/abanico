<script>
$(window).on('load',function(){
  $('#borrar_perfil').click(function (){

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
        var enlace = $('#borrar_perfil').data('enlace');
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
