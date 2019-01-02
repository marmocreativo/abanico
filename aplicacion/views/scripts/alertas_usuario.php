<script>
jQuery(window).on('load',function(){
  jQuery('.borrar_entrada').click(function (){

    Swal({
      title: '¿Estas seguro?',
      text: "Esta acción no se puede deshacer.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, estoy seguro!',
      cancelButtonText: 'Mejor no.',
    }).then((result) => {
      if (result.value) {
        var enlace = jQuery(this).data('enlace');
        window.location=enlace;
      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        Swal(
          'Cancelado',
          'Tu cuenta está segura :)',
          'success'
        )
      }
    });
  });
});
</script>
