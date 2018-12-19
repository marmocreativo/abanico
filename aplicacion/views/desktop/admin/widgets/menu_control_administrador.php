<div class="nav-side-menu">
        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li class="<?php echo 'bg'.$primary; ?>">
                  <a href="<?php echo base_url('admin'); ?>">
                  <i class="fa fa-tachometer-alt"></i> Escritorio
                  </a>
                </li>
              <li  data-toggle="collapse" data-target="#usuarios" class="collapsed <?php echo 'bg'.$primary; ?>">
                <a href="#"><i class="fa fa-users"></i> Usuarios <span class="arrow"></span></a>
              </li>
                <ul class="sub-menu collapse" id="usuarios">
                  <!--
                  Lista de tipos de Usuarios

                    Clientes usr-1
                    Vendedores vnd-2
                    Trabajadaores trb-3
                    Administradores adm-4
                    SuperAdmin spa-5
                  -->
                    <li><a href="<?php echo base_url('admin/usuarios?tipo_usuario=usr-1'); ?>">Usuarios (Clientes)</a></li>
                    <li><a href="<?php echo base_url('admin/usuarios?tipo_usuario=vnd-2'); ?>">Vendedores</a></li>
                    <li><a href="<?php echo base_url('admin/usuarios?tipo_usuario=adm-4'); ?>">Administradores</a></li>
                    <!--
                    <li><a href="<?php echo base_url('admin/lista_correos'); ?>">Lista de correos</a></li>
                  -->
                </ul>
               <li  data-toggle="collapse" data-target="#categorias" class="collapsed <?php echo 'bg'.$primary; ?>">
                 <a href="#"><i class="fa fa-th-list"></i> Categorias <span class="arrow"></span></a>
               </li>
                 <ul class="sub-menu collapse" id="categorias">
                     <li><a href="<?php echo base_url('admin/categorias?tipo_categoria=productos'); ?>">Categorias Minoristas</a></li>
                     <li><a href="<?php echo base_url('admin/categorias?tipo_categoria=mayoreo'); ?>">Categorias Mayoristas</a></li>
                     <li><a href="<?php echo base_url('admin/categorias?tipo_categoria=servicios'); ?>">Categorias Servicios</a></li>
                 </ul>
                <li  data-toggle="collapse" data-target="#productos" class="collapsed <?php echo 'bg'.$primary; ?>">
                  <a href="#"><i class="fa fa-boxes"></i> Productos <span class="arrow"></span></a>
                </li>
                  <ul class="sub-menu collapse" id="productos">
                      <li><a href="<?php echo base_url('admin/productos?tipo=normal'); ?>">Productos Minoristas</a></li>
                  </ul>
                  <li  data-toggle="collapse" data-target="#tiendas" class="collapsed <?php echo 'bg'.$primary; ?>">
                    <a href="#"><i class="fa fa-store"></i> Tiendas <span class="arrow"></span></a>
                  </li>
                    <ul class="sub-menu collapse" id="tiendas">
                        <li><a href="<?php echo base_url('admin/tiendas'); ?>">Tiendas</a></li>
                    </ul>
                    <!--
                <li  data-toggle="collapse" data-target="#servicios" class="collapsed <?php echo 'bg'.$primary; ?>">
                  <a href="#"><i class="fa fa-tools"></i> Servicios <span class="arrow"></span></a>
                </li>
                  <ul class="sub-menu collapse" id="servicios">
                      <li><a href="<?php echo base_url('admin/servicios'); ?>">Servicios</a></li>
                  </ul>
                -->
                  <li  data-toggle="collapse" data-target="#monedas" class="collapsed <?php echo 'bg'.$primary; ?>">
                    <a href="#"><i class="fa fa-money-bill"></i> Monedas y Sistemas de Pagos <span class="arrow"></span></a>
                  </li>
                    <ul class="sub-menu collapse" id="monedas">
                        <li><a href="<?php echo base_url('admin/divisas'); ?>">Divisas</a></li>
                    </ul>
                  <li  data-toggle="collapse" data-target="#products" class="collapsed <?php echo 'bg'.$primary; ?>">
                    <a href="#"><i class="fa fa-globe"></i> Internacionalizar <span class="arrow"></span></a>
                  </li>
                  <!--
                    <ul class="sub-menu collapse" id="products">
                        <li><a href="<?php echo base_url('admin/paises'); ?>">Paises</a></li>
                        <li><a href="<?php echo base_url('admin/lenguajes'); ?>">Lenguajes</a></li>
                    </ul>
                  <li class="<?php echo 'bg'.$primary; ?>">
                    <a href="<?php echo base_url('admin/pagina?tipo=informacion'); ?>">
                      <i class="fa fa-file-alt"></i> Información Abanico
                    </a>
                  </li>
                <li  data-toggle="collapse" data-target="#sliders" class="collapsed <?php echo 'bg'.$primary; ?>">
                  <a href="#"><i class="fa fa-images"></i> Sliders y Banners <span class="arrow"></span></a>
                </li>
                  <ul class="sub-menu collapse" id="sliders">
                      <li><a href="<?php echo base_url('admin/sliders'); ?>">Sliders</a></li>
                      <li><a href="<?php echo base_url('admin/banners'); ?>">Banners</a></li>
                  </ul>
                  <li  data-toggle="collapse" data-target="#ayuda" class="collapsed <?php echo 'bg'.$primary; ?>">
                    <a href="#"><i class="fa fa-question-circle"></i> Centro de Ayuda <span class="arrow"></span></a>
                  </li>
                    <ul class="sub-menu collapse" id="ayuda">
                        <li><a href="<?php echo base_url('admin/categorias?tipo_categoria=ayuda'); ?>">Temas (categorias)</a></li>
                        <li><a href="<?php echo base_url('admin/pagina?tipo=ayuda'); ?>">Páginas de ayuda</a></li>
                        <li><a href="<?php echo base_url('admin/preguntas?tipo=pagina'); ?>">Preguntas Frecuentes</a></li>
                    </ul>
                  <li class="<?php echo 'bg'.$primary; ?>">
                    <a href="<?php echo base_url('admin/configuracion'); ?>">
                      <i class="fa fa-cogs"></i> Configuraciones
                    </a>
                  </li>

                -->
            </ul>
     </div>
</div>
<!--
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action"> <span class="fa fa-envelope"></span> Mensajes</a>
  <a href="#" class="list-group-item list-group-item-action"> <span class="fa fa-shopping-bag"></span> Mis compras</a>

  <a href="<?php echo base_url('admin/usuarios?tipo_usuario=usr-1');?>" class="list-group-item list-group-item-action"> <span class="fa fa-user"></span> Usuarios</a>
  <a href="<?php echo base_url('admin/divisas');?>" class="list-group-item list-group-item-action"> <span class="fa fa-money-bill"></span> Divisas</a>
  <a href="<?php echo base_url('admin/lenguajes');?>" class="list-group-item list-group-item-action"> <span class="fa fa-globe"></span> Lenguajes</a>
  <a href="<?php echo base_url('admin/paises');?>" class="list-group-item list-group-item-action"> <span class="fa fa-globe-americas"></span> Paises</a>
  <a href="<?php echo base_url('usuario/datos_usuario');?>" class="list-group-item list-group-item-action"> <span class="fa fa-address-card"></span> Mis datos</a>
  <a href="#" class="list-group-item list-group-item-action"> <span class="fa fa-user-lock"></span> Seguridad</a>
</div>
-->
