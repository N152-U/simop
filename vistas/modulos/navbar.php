<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->

<!-- Site wrapper -->


<header class="main-header">
  <!-- Logo -->
  <a class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini text-gray"><b class="text-blue">SC</b>MX</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b class="text-blue">SAC</b><b class="text-gray">MEX</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar">
    <!-- Sidebar toggle button-->

    <div class="nav-wrapper">



      <ul class="left">
        <a href="#" class="waves-effect sidebar-toggle" data-toggle="push-menu" role="button">
          <i class="fas fa-bars fa-sm"></i>
        </a>

      </ul>

      <ul class="brand-logo center text-black">
        <li>
          <h5 id="titulo_seccion" style="margin-top: 2vh; text-align: center;"><?php echo $respuesta["titulo"]; ?></h5>



        </li>
      </ul>

      <ul class="right">

        <div class="fixed-action-btn horizontal direction-top direction-right" style="
    top: 9vh;
    right: 0vw;
    height: 40px;
    padding:0px;
    ">
          <!-- <a class="tooltiped" id="ayuda" data-position="bottom" data-tooltip="Ayuda"><i class="material-icons left text-black">help</i> </a>-->

        </div>

        <div class="" style="
    top: 0vh;
    right: 0vw;
    height: 46px;
      ">
          <?php if (isset($respuesta["ruta_regreso"]) && $respuesta["ruta_regreso"] != "") {
            echo '<a class="waves-effect tooltiped" data-position="bottom" data-tooltip="Regresar" href="' . SERVERURL . $respuesta["ruta_regreso"] . '"><i class="material-icons left text-black">arrow_back</i></a>';
          }
          ?>

        </div>

      </ul>

      <ul id="notificaciones" hidden class="right">

          <div class="" style="">

            <a href="<?php echo SERVERURL; ?>novedades" class="waves-effect black-text" style="height: 64px;display: inline-block;"><i class="material-icons" style="display: inline-block">message</i>
              
                <span class="new badge" id="cantidad_mensajes">0</span>
             
            </a>
           

          </div>
      </ul>
    </div>

  </nav>
</header>

<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar white">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="height: auto;">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="fa-pull-left image">
        <img src="<?php echo SERVERURL ?>vistas/assets/images/sacmex.png" class="img-circle" alt="User Image">
      </div>
      <div class="fa-pull-left info">
        <a href="#">
          <div style="white-space: normal;" class="col s12"><b><?php echo $_SESSION[GUID]['nombre']; ?></b><br>(<?php echo $_SESSION[GUID]['rol']; ?>)</div>
          <img  src="<?php echo SERVERURL ?>vistas/assets/images/icons/circle-info-solid.png" width="10" height="10"/> En línea
        </a>
      </div>
    </div>
    <ul class="sidebar-menu tree" data-widget="tree">

      <li class="treeview" id="administracion" hidden>
        <a href="#">
        <img  src="<?php echo SERVERURL ?>vistas/assets/images/icons/shield-solid.svg" width="18" height="18"/><span> Administración</span><span class="pull-right-container">
            <i class="fad fa-angle-left pull-right"></i>
          </span>
        </a>
        
        <ul class="treeview-menu">
          <li id="gestion_roles" hidden><a href="<?php echo SERVERURL ?>roles"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/user-lock-solid.svg" width="15" height="15"/><span> Gestión de Roles</span></a></li>
          <li id="gestion_usuarios" hidden><a href="<?php echo SERVERURL ?>usuarios"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/users-gear-solid.svg" width="15" height="15"/><span> Gestión de Usuarios</span></a></li>
        </ul>
      </li>

      <li><a href="<?php echo SERVERURL ?>home"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/home-solid.svg" width="18" height="18"/><span> Inicio</span></a></li>

      <li id="el_tablero" hidden><a href="<?php echo SERVERURL ?>tablero"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/chart-column-solid.svg" width="18" height="18"/><span> Tablero</span></a></li>

      <li id="el_comparativo_scada" hidden><a href="<?php echo SERVERURL ?>comparativoScada"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/scale-balanced-solid.svg" width="18" height="18"/><span> Comparativo Scada</span></a></li>

      <li id="el_hist_sist" hidden>
        <a href="<?php echo SERVERURL ?>historicoSistemas"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/magnifying-glass-solid.svg" width="18" height="18"/><span> Compendio Sistemas</span></a>
      </li>

   <!--    <li class="treeview" id="riego" hidden>
        <a href="#">
          <i class="fas fa-water"></i>
          <span>Riego</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li id="otro3"><a href="<?php echo SERVERURL ?>progsRiego"><i class="fas fa-shower" aria-hidden="true"></i> <span>Programas de Riego</span></a></li>
          <li id="otro1"><a href="<?php echo SERVERURL ?>regFuentes"><i class="fas fa-hand-holding-medical" aria-hidden="true"></i> <span>Registro de fuentes</span></a></li>
          <li id="otro2"><a href="<?php echo SERVERURL ?>controlAvance"><i class="fas fa-hand-holding-water" aria-hidden="true"></i> <span>Control de avances</span></a></li>

        </ul>
      </li> -->

      <li class="treeview" id="capturas" hidden>
        <a href="#">
        <img src="<?php echo SERVERURL ?>vistas/assets/images/icons/pen-to-square-solid.svg" width="18" height="18"/>
          <span> Captura</span>
          <span class="pull-right-container">
          <i class="fad fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
         
          <li id="punto" hidden><a href="<?php echo SERVERURL ?>captura"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/circle-regular.svg" width="15" height="15"/><span> Puntos</span></a></li>
          <li id="tanque" hidden><a href="<?php echo SERVERURL ?>tanque"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/circle-solid.svg" width="15" height="15"/><span> Tanques</span></a></li>
          <li id="subestacion" hidden><a href="<?php echo SERVERURL ?>subestaciones"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/bolt-lightning-solid.svg" width="15" height="15"/><span> Subestaci&oacute;nes</span></a></li>
          <li id="controlRiego" hidden><a href="<?php echo SERVERURL ?>controlRiego"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/water-solid.svg" width="15" height="15"/><span> Programa de Riego</span></a></li>
          <li id="lumbrera" hidden><a href="<?php echo SERVERURL ?>capturaLumbrera"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/circle-regular.svg" width="15" height="15"/><span> Lumbreras</span></a></li>
        </ul>
      </li>

      <li class="treeview" id="historicos" hidden>
        <a href="#">
        <img src="<?php echo SERVERURL ?>vistas/assets/images/icons/clock-rotate-left-solid.svg" width="18" height="18"/>
          <span> Historico</span>
          <span class="pull-right-container">
            <i class="fad fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="histPozo" hidden><a href="<?php echo SERVERURL ?>historico"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/circle-notch-solid.svg" width="15" height="15"/><span> Puntos</span></a></li>
          <li id="histTanque" hidden><a href="<?php echo SERVERURL ?>histTanque"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/cubes-solid.svg" width="15" height="15"/><span> Tanques</span></a></li>
          <li id="histSub" hidden><a href="<?php echo SERVERURL ?>histSub"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/spinner-solid.svg" width="15" height="15"/><span> Subestaci&oacute;nes</span></a></li>
        </ul>
      </li>

      <li class="treeview" id="reportes_radio" hidden>
        <a href="#">
        <img src="<?php echo SERVERURL ?>vistas/assets/images/icons/tower-broadcast-solid.svg" width="18" height="18"/>
          <span> Reportes de Radio</span>
          <span class="pull-right-container">
            <i class="fad fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="notas" hidden><a href="<?php echo SERVERURL ?>notas"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/note-sticky-solid.svg" width="15" height="15"/><span> Notas</span></a></li>
          <li id="novedades" hidden><a href="<?php echo SERVERURL ?>novedades"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/clipboard-solid.svg" width="15" height="15"/><span> Novedades</span></a></li>
          <li id="reportes" hidden><a href="<?php echo SERVERURL ?>reportes"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/file-contract-solid.svg" width="15" height="15"/> <span> Reportes</span></a></li>
        </ul>
      </li>

      <li hidden><a href="<?php echo SERVERURL ?>home"><i class="far fa-faucet-drip"></i> <span>Programa de Riego</span></a></li>
      <li id="informe_sistemas" hidden><a href="<?php echo SERVERURL ?>reporteSistemas"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/file-invoice-solid.svg" width="18" height="18"/>  <span>Informe de Sistemas</span></a></li>
      <li hidden><a href="<?php echo SERVERURL ?>mapa"><i class="fa fa-map"></i> <span>Mapa</span></a></li>
      <li><a href="<?php echo SERVERURL ?>contacto"><img src="<?php echo SERVERURL ?>vistas/assets/images/icons/circle-info-solid.svg" width="18" height="18"/>  <span> Contacto</span></a></li>
      <li><a class="btn-exit-system" href="<?php echo $lc->encryption($_SESSION[GUID]['pwd']); ?>"><img class=" text-green" src="<?php echo SERVERURL ?>vistas/assets/images/icons/power-off-solid.png" width="18" height="18"/> <span>Cerrar sesión</span></a></li>
          
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/navbar.js?v=<?php echo VERSION; ?>"></script>

