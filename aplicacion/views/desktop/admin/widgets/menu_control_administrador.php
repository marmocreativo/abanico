<ul class="kt-menu__nav ">
  <li class="kt-menu__item  kt-menu__item--active">
    <a href="<?php echo base_url('admin'); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Resumen</span></a>
  </li>
  <!--
  ** Pedidos
  -->
  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-white">Pedidos</span><i class="kt-menu__hor-arrow fa fa-chevron-down"></i><i class="kt-menu__ver-arrow fa fa-chevron-down"></i></a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/pedidos'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-shopping-bag"></i></i><span class="kt-menu__link-text">Lista de Pedidos</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/pedidos/devoluciones'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-undo"></i></i><span class="kt-menu__link-text">Devoluciones</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/corte_vendedores'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file-invoice"></i></i><span class="kt-menu__link-text">Corte de Ventas</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/corte_planes'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file-invoice"></i></i><span class="kt-menu__link-text">Corte de Planes</span></a>
        </li>
      </ul>
    </div>
  </li>
  <!--
  ** Productos
  -->
  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-white">Productos</span><i class="kt-menu__hor-arrow fa fa-chevron-down"></i><i class="kt-menu__ver-arrow fa fa-chevron-down"></i></a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/productos?tipo=normal'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-box"></i></i><span class="kt-menu__link-text">Lista de Productos</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/categorias?tipo_categoria=productos'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-boxes"></i></i><span class="kt-menu__link-text">Categorias de Productos</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/tiendas'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-store"></i></i><span class="kt-menu__link-text">Tiendas Vendedores</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/planes/lista_planes_usuarios?Tipo=productos'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file-signature"></i></i><span class="kt-menu__link-text">Planes vendedores</span></a>
        </li>
      </ul>
    </div>
  </li>
  <!--
  ** Servicios
  -->
  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-white">Servicios</span><i class="kt-menu__hor-arrow fa fa-chevron-down"></i><i class="kt-menu__ver-arrow fa fa-chevron-down"></i></a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/servicios?tipo=normal'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-tools"></i></i><span class="kt-menu__link-text">Lista de Servicios</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/categorias?tipo_categoria=servicios'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-tools"></i></i><span class="kt-menu__link-text">Categorias de Servicios</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/perfiles_servicios'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user-tie"></i></i><span class="kt-menu__link-text">Perfiles Servicios</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/planes/lista_planes_usuarios?Tipo=servicios'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file-signature"></i></i><span class="kt-menu__link-text">Planes servicios</span></a>
        </li>
      </ul>
    </div>
  </li>

  <!--
  ** Usuarios
  -->
  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-white">Usuarios</span><i class="kt-menu__hor-arrow fa fa-chevron-down"></i><i class="kt-menu__ver-arrow fa fa-chevron-down"></i></a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user"></i></i><span class="kt-menu__link-text">Todos</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios?tipo_usuario=usr-1'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user"></i></i><span class="kt-menu__link-text">Clientes</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios?tipo_usuario=vnd-2'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user-tag"></i></i><span class="kt-menu__link-text">Solo Vendedores</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios?tipo_usuario=ser-3'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user-tie"></i></i><span class="kt-menu__link-text">Solo Servicios</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios?tipo_usuario=vns-4'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user-tie"></i></i><span class="kt-menu__link-text">Vendedores y Servicio</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios?tipo_usuario=tec-5'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user-cog"></i></i><span class="kt-menu__link-text">Técnicos</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/usuarios?tipo_usuario=adm-6'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-user-lock"></i></i><span class="kt-menu__link-text">Administradores</span></a>
        </li>
      </ul>
    </div>
  </li>
  <!--
  ** Envios
  -->
  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-white">Sistemas</span><i class="kt-menu__hor-arrow fa fa-chevron-down"></i><i class="kt-menu__ver-arrow fa fa-chevron-down"></i></a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/divisas'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-money-bill"></i></i><span class="kt-menu__link-text">Divisas</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/paises'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-globe-americas"></i></i><span class="kt-menu__link-text">Paises</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/lenguajes'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-language"></i></i><span class="kt-menu__link-text">Lenguajes</span></a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/transportistas'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-truck"></i></i><span class="kt-menu__link-text">Transportistas</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/puntos_registro'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-map-marker"></i></i><span class="kt-menu__link-text">Puntos de Control</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/guias'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file"></i></i><span class="kt-menu__link-text">Guías Abanico</span></a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/planes'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file"></i></i><span class="kt-menu__link-text">Planes Generales</span></a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/concursos'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-gift"></i></i><span class="kt-menu__link-text">Concursos</span></a>
        </li>
      </ul>
    </div>
  </li>
  <!--
  ** Publicaciones
  -->
  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-white">Publicaciones</span><i class="kt-menu__hor-arrow fa fa-chevron-down"></i><i class="kt-menu__ver-arrow fa fa-chevron-down"></i></a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/sliders'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-images"></i></i><span class="kt-menu__link-text">Sliders</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/publicaciones?tipo_publicacion=acerca'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file"></i></i><span class="kt-menu__link-text">Acerca de Abanico</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/publicaciones?tipo_publicacion=legales'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file"></i></i><span class="kt-menu__link-text">Legales</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/publicaciones?tipo_publicacion=concursos'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file"></i></i><span class="kt-menu__link-text">Concursos</span></a>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/publicaciones?tipo_publicacion=ayuda'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-file"></i></i><span class="kt-menu__link-text">Ayuda</span></a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
          <a href="<?php echo base_url('admin/premios'); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet"><i class="fa fa-gift"></i></i><span class="kt-menu__link-text">Lista de Premios</span></a>
        </li>
      </ul>
    </div>
  </li>
</ul>
