<!DOCTYPE html>
<html lang="es">

	<!-- begin::Head -->
	<head>

		<!--begin::Base Path (base relative path for assets of this page) -->
		<base href="../">

		<!--end::Base Path -->
		<meta charset="utf-8" />
		<title>Administrador | <?php echo $op['titulo_sitio'] ?></title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->

		<!--end::Page Vendors Styles -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
    <link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/custom/jquery-ui/jquery-ui.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/animate.css/animate.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css" />

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.css">
		<link href="<?php echo base_url('assets/metronic/'); ?>demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/metronic/'); ?>demo/default/base/custom.css?v=<?php echo date('U'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/global/'); ?>css/estilos_abanico_administrador.css?v=<?php echo date('U'); ?>" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/global/'); ?>img/favicon.png" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body style="background-image: url(<?php echo base_url('assets/metronic/'); ?>media/demos/demo8/bg-1.jpg)" class="kt-page--fluid kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="<?php echo base_url('admin'); ?>">
					<img alt="Logo" src="<?php echo base_url('assets/metronic/'); ?>media/logos/logo-8.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
						<div class="kt-header__top">
							<div class="kt-container">

								<!-- begin:: Brand -->
								<div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
									<div class="kt-header__brand-logo">
										<a href="<?php echo base_url('admin'); ?>">
											<img alt="Logo" src="<?php echo base_url('assets/metronic/'); ?>media/logos/logo-8.png" class="kt-header__brand-logo-default" />
											<img alt="Logo" src="<?php echo base_url('assets/metronic/'); ?>media/logos/logo-8-inverse.png" class="kt-header__brand-logo-sticky" />
										</a>
									</div>
								</div>

								<!-- end:: Brand -->

								<!-- begin:: Header Topbar -->
								<div class="kt-header__topbar">
                  <a href="<?php echo base_url(); ?>" class="btn btn-outline-warning btn-sm mt-2"><i class="fa fa-shopping-bag"></i> Volver a la tienda Principal</a>
                  <a href="<?php echo base_url('usuario'); ?>" class="btn btn-outline-warning btn-sm mt-2"><i class="fa fa-user"></i> Panel de Control Usuario</a>
									<?php $this->load->view('desktop/admin/widgets/widget_notificaciones'); ?>



									<!--begin: User bar -->
									<div class="kt-header__topbar-item kt-header__topbar-item--user">
										<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
											<img alt="Pic" src="<?php echo base_url('assets/'); ?>global/img/usuario_default.png" />
											<span class="kt-header__topbar-icon kt-bg-brand kt-font-lg kt-font-bold kt-font-light kt-hidden">S</span>
											<span class="kt-header__topbar-icon kt-hidden"><i class="flaticon2-user-outline-symbol"></i></span>
										</div>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

											<!--begin: Head -->
											<div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
												<div class="kt-user-card__avatar">
													<img class="kt-hidden-" alt="Pic" src="<?php echo base_url('assets/'); ?>global/img/usuario_default.png" />

													<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
													<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
												</div>
												<div class="kt-user-card__name">
													<?php echo $_SESSION['usuario']['nombre']; ?>
												</div>
											</div>

											<!--end: Head -->

											<!--begin: Navigation -->
											<div class="kt-notification">
												<a href="<?php echo base_url('admin/usuarios/perfil?id_usuario='.$_SESSION['usuario']['id']); ?>" class="kt-notification__item">
													<div class="kt-notification__item-icon">
														<i class="flaticon2-calendar-3 kt-font-success"></i>
													</div>
													<div class="kt-notification__item-details">
														<div class="kt-notification__item-title kt-font-bold">
															Mi Perfil
														</div>
														<div class="kt-notification__item-time">
															Datos personales y contraseña
														</div>
													</div>
												</a>
												<div class="kt-notification__custom kt-space-between">
													<a href="<?php echo base_url('login/cerrar'); ?>" target="_blank" class="btn btn-clean btn-sm btn-bold">Cerrar Sesión</a>
												</div>
											</div>

											<!--end: Navigation -->
										</div>
									</div>

									<!--end: User bar -->

								</div>

								<!-- end:: Header Topbar -->
							</div>
						</div>
						<div class="kt-header__bottom">
							<div class="kt-container">

								<!-- begin: Header Menu -->
								<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
								<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
									<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
										<?php $this->load->view('desktop/admin/widgets/menu_control_administrador'); ?>
									</div>
								</div>

								<!-- end: Header Menu -->
							</div>
						</div>
					</div>

					<!-- end:: Header -->
