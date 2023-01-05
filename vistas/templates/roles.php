<?php
require_once "./controladores/rolesControlador.php";
?>


<main>

    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>vistas/assets/css/roles.css?v=<?php echo VERSION; ?>" />

    <div class="container">

        <div class="row">
            <div class="col s12">
                <div class="row">
                    <h3 style="display: inline-block;">Roles</h3>

                    <a class="right tooltipped" id='crear-rol' href="<?php echo SERVERURL; ?>rol" data-position="bottom" data-tooltip="Crear Rol" style="display: inline-block; margin: 2.3733333333rem 0 1.424rem 0;"><i class="medium material-icons indigo-text left">add</i></a>
                </div>

                <ul id="tabs_roles" style="display: inline-block;" class="tabs">
                    <li class="tab col s6">
                        <a class="active" href="#tab_roles_activos">Roles activos</a>
                    </li>

                    <li class="tab col s6">
                        <a href="#tab_roles_inactivos">Roles inactivos</a>
                    </li>
                </ul>
                <div id="tab_roles_activos" class="tab-contenedor row roles">
                    <table class="bordered highlight striped " style="width: 100%;" id="tabla_roles_activos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($rolesActivosContenedor as $key => $rol) {

                                echo "<tr>";
                                echo "<td>" . ($key + 1) . "</td>";
                                echo "<td>" . $rol["rol"] . "</td>";
                                echo "<td style='text-align: center'>
                                        <a href=" . SERVERURL . 'rol/' . $rol["id"] . " class='btn buttons-accion leer-rol green'>
                                            <!--<b>LEER</b>--><i class='small material-icons white-text fas fa-eye'></i>
                                        </a>
                                        <a href=" . SERVERURL . 'rol/' . $rol["id"] . " class='btn buttons-accion editar-rol blue'>
                                            <!--<b>EDITAR</b>--><i class='small material-icons white-text fas fa-edit'></i>
                                        </a>
                                        <a href='#!' onclick='eliminar_rol(" . $rol["id"] . ")' class='btn buttons-accion eliminar-rol red'>
                                            <!--<b>DESACTIVAR</b>--><i class='small material-icons white-text'>delete</i>
                                        </a>
                                   
                                </td>";
                                echo "</tr>";


                                echo "</tr>";
                            } ?>

                        </tbody>

                    </table>
                </div>

                <div id="tab_roles_inactivos" class="tab-contenedor row roles">

                    <table class="bordered highlight striped " style="width: 100%;" id="tabla_roles_inactivos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            ?>

                            <?php foreach ($rolesInactivosContenedor as $key => $rol) {

                                echo "<tr>";
                                echo "<td>" . ($key + 1) . "</td>";
                                echo "<td>" . $rol["rol"] . "</td>";
                                echo "<td style='text-align: center'>
                                    <form action=" . SERVERURL . 'rol/' . $rol["id"] . "> 
                                    
                                        <button onclick='restablecer_rol(" . $rol["id"] . ")' class='btn restablecer-rol yellow' type='button'>
                                            <!--<b>RESTABLECER</b>--><i class='small material-icons white-text'>refresh</i>
                                        </button>
                                       
                                    </form>
                                </td>";
                                echo "</tr>";


                                echo "</tr>";
                            } ?>

                        </tbody>

                    </table>

                </div>
            </div>
        </div>



    </div>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/roles.js?v=<?php echo VERSION; ?>"></script>
   

</main>