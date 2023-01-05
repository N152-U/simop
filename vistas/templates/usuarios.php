<?php
require_once "./controladores/usuariosControlador.php";
?>


<main>

<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/assets/css/usuarios.css?v=<?php echo VERSION; ?>" />

    <div class="container">

        <div class="row">
            <div class="col s12">
                <div class="row">
                    <h3 style="display: inline-block;">Usuarios</h3>
                    <a class="right tooltipped crear-usuario" href="<?php echo SERVERURL; ?>usuario" data-position="bottom" data-tooltip="Crear Usuario" style="display: inline-block; margin: 2.3733333333rem 0 1.424rem 0;"><i class="medium material-icons indigo-text left">add</i></a>
                </div>
                <ul id="tabs_usuarios" style="display: inline-block;" class="tabs">
                    <li class="tab col s6">
                        <a class="active" href="#tab_usuarios_activos">Usuarios activos</a>
                    </li>

                    <li class="tab col s6">
                        <a href="#tab_usuarios_inactivos">Usuarios inactivos</a>
                    </li>
                </ul>
                <div id="tab_usuarios_activos" class="tab-contenedor row usuarios">
                    <table class="bordered highlight striped " style="width: 100%" id="tabla_usuarios_activos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                   

                            <?php foreach ($usuariosActivosContenedor as $key => $usuario) {

                                echo "<tr>";
                                echo "<td>" . ($key + 1) . "</td>";
                                echo "<td>" . $usuario["usuario"] . "</td>";
                                echo "<td>" . $usuario["nombre"] . "</td>";
                                echo "<td>" . $usuario["rol"] . "</td>";
                                echo "<td>
                                            <a href=" . SERVERURL . 'usuario/' . $usuario["id"] . " class='btn buttons-accion leer-usuario green'>
                                                <!--<b>LEER</b>--><i class='small material-icons white-text fas fa-eye'></i>
                                            </a>
                                            <a href=" . SERVERURL . 'usuario/' . $usuario["id"] . " class='btn buttons-accion editar-usuario blue'>
                                                <!--<b>EDITAR</b>--><i class='small material-icons white-text fas fa-edit'></i>
                                            </a>
                                            <a href='#!' onclick='eliminar_usuario(". $usuario["id"] . ")' class='btn buttons-accion eliminar-usuario red'>
                                                <!--<b>ELIMINAR</b>--><i class='small material-icons white-text'>delete</i>
                                            </a> 
                                       
                                    </td>";

                                echo "</tr>";
                            } ?>

                        </tbody>
                    </table>
                </div>

                <div id="tab_usuarios_inactivos" class="tab-contenedor row usuarios">

                    <table class="bordered highlight striped" style="width:100%" id="tabla_usuarios_inactivos">
                    <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                   

                            <?php foreach ($usuariosInactivosContenedor as $key => $usuario) {

                                echo "<tr>";
                                echo "<td>" . ($key + 1) . "</td>";
                                echo "<td>" . $usuario["usuario"] . "</td>";
                                echo "<td>" . $usuario["nombre"] . "</td>";
                                echo "<td>" . $usuario["rol"] . "</td>";
                                echo "<td>
                                        <form action=" . SERVERURL . 'usuario/' . $usuario["id"] . "> 
                                            <button onclick='restablecer_usuario(". $usuario["id"] . ")' class='btn buttons-accion eliminar-usuario yellow' type='button'>
                                                <!--<b>RESTABLECER</b>--><i class='small material-icons white-text'>refresh</i>
                                            </button> 
                                        </form> 
                                    </td>";

                                echo "</tr>";
                            } ?>

                        </tbody>

                    </table>


                </div>
            </div>
        </div>



    </div>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/usuarios.js?v=<?php echo VERSION; ?>"></script>
  

</main>