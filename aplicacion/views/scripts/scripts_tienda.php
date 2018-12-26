<script type="text/javascript">
// select all thumbnails
  const galleryThumbnail = document.querySelectorAll(".thumbnails-list li");
  // select featured
  const galleryFeatured = document.querySelector(".product-gallery-featured img");

  // loop all items
  galleryThumbnail.forEach((item) => {
    item.addEventListener("mouseover", function () {
      let image = item.children[0].src;
      galleryFeatured.src = image;
    });
  });

  $(function() {
      $('#EstrellasCalificacion').barrating({
        theme: 'fontawesome-stars'
      });
   });
</script>
