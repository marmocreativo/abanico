<ul class="nav navbar-nav">
    <li>
        <a href="<?php echo base_url('admin'); ?>"><i class="menu-icon fa fa-laptop"></i>Escritorio </a>
    </li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-bag"></i>Pedidos</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-shopping-bag"></i><a href="<?php echo base_url('admin/pedidos'); ?>">Pedidos</a></li>
        </ul>
    </li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Listas de Usuarios</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-user"></i><a href="<?php echo base_url('admin/usuarios?tipo_usuario=usr-1'); ?>">Usuarios (Clientes)</a></li>
          <li><i class="fa fa-user-tag"></i><a href="<?php echo base_url('admin/usuarios?tipo_usuario=vnd-2'); ?>">Vendedores</a></li>
          <li><i class="fa fa-user-tie"></i><a href="<?php echo base_url('admin/usuarios?tipo_usuario=ser-3'); ?>">Servidores</a></li>
          <li><i class="fa fa-user-tie"></i><a href="<?php echo base_url('admin/usuarios?tipo_usuario=vns-4'); ?>">Ven-Serv</a></li>
          <li><i class="fa fa-user-cog"></i><a href="<?php echo base_url('admin/usuarios?tipo_usuario=tec-5'); ?>">Técnico Abanico</a></li>
          <li><i class="fa fa-user-lock"></i><a href="<?php echo base_url('admin/usuarios?tipo_usuario=adm-6'); ?>">Administradores</a></li>
        </ul>
    </li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-store"></i>Tiendas</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-store"></i><a href="<?php echo base_url('admin/tiendas'); ?>"> Tiendas</a></li>
        </ul>
    </li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tools"></i>Servicios</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-user-tie"></i><a href="<?php echo base_url('admin/perfiles_servicios'); ?>"> Perfiles</a></li>
          <li><i class="fa fa-envelope"></i><a href="<?php echo base_url('admin/servidores_mensajes'); ?>"> Mensajes</a></li>
        </ul>
    </li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list"></i>Categorías</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-box"></i><a href="<?php echo base_url('admin/categorias?tipo_categoria=productos'); ?>">Categorias Productos</a></li>
          <li><i class="fa fa-tools"></i><a href="<?php echo base_url('admin/categorias?tipo_categoria=servicios'); ?>">Categorias Servicios</a></li>
        </ul>
    </li>
    <li><a href="<?php echo base_url('admin/productos?tipo=normal'); ?>"><i class="menu-icon fa fa-box"></i> Productos Minoristas</a></li>
    <li><a href="<?php echo base_url('admin/productos?tipo=mayorista'); ?>"><i class="menu-icon fa fa-boxes"></i> Productos Mayoristas</a></li>
    <li><a href="<?php echo base_url('admin/servicios'); ?>"><i class="menu-icon fa fa-tools"></i> Servicios</a></li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-truck"></i>Envios y Transporte</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-truck"></i><a href="<?php echo base_url('admin/transportistas'); ?>">Transportistas</a></li>
          <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url('admin/puntos_registro'); ?>">Puntos de Registro</a></li>
          <li><i class="fa fa-recipt"></i><a href="<?php echo base_url('admin/guias'); ?>">Guías Abanico</a></li>
        </ul>
    </li>
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-globe"></i>Internacional</a>
        <ul class="sub-menu children dropdown-menu">
          <li><i class="fa fa-money-bill"></i><a href="<?php echo base_url('admin/divisas'); ?>">Divisas</a></li>
          <li><i class="fa fa-globe-americas"></i><a href="<?php echo base_url('admin/paises'); ?>">Paises</a></li>
          <li><i class="fa fa-language"></i><a href="<?php echo base_url('admin/lenguajes'); ?>">Lenguajes</a></li>
        </ul>
    </li>
    <!--
    <li class="menu-item-has-children dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list"></i>Sliders</a>
        <ul class="sub-menu children dropdown-menu">
          <li><a href="<?php echo base_url('admin/sliders'); ?>">Sliders</a></li>
        </ul>
    </li>
  -->
</ul>
