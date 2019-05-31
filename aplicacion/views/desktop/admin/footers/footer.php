<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item" id="kt_footer">
  <div class="kt-container">
    <div class="kt-footer__wrapper">
      <div class="kt-footer__copyright">
        2019&nbsp;&copy;&nbsp;<a href="<?php echo base_url(); ?>" target="_blank" class="kt-link">Abanico</a>
      </div>
    </div>
  </div>
</div>

<!-- end:: Footer -->
</div>
</div>
</div>

<!-- end:: Page -->



<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
<i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
var KTAppOptions = {
"colors": {
"state": {
  "brand": "#716aca",
  "light": "#ffffff",
  "dark": "#282a3c",
  "primary": "#5867dd",
  "success": "#34bfa3",
  "info": "#36a3f7",
  "warning": "#ffb822",
  "danger": "#fd3995"
},
"base": {
  "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
  "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
}
}
};
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/iconpicker/dist/js/fontawesome-iconpicker.min.js" type="text/javascript"></script>
<!--
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/summernote/lang/summernote-es-ES.js" type="text/javascript"></script>
-->
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/custom/components/vendors/bootstrap-datepicker/init.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>

<!--end:: Global Optional Vendors -->
<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url('assets/metronic/'); ?>demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/js/trumbowyg/trumbowyg.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/js/trumbowyg/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/js/trumbowyg/plugins/table/trumbowyg.table.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/js/sweetalert2/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/localization/messages_es.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
<?php $this->load->view('scripts/formularios_usuario');  ?>
<?php $this->load->view('scripts/alertas_usuario');  ?>
<?php $this->load->view('scripts/scripts_admin');  ?>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
