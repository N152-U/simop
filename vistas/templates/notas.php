<?php
require_once "./controladores/notasControlador.php";
?>

<main>

    <div class="container">

        <form id="formularioNotas method=" post" enctype="multipart/form-data">


            <div class="row">
                <div class="col s12 m2">
                    <b>Descripción:</b>
                </div>
                <div class="col s12 m8">

                    <textarea onkeyup="withSelectionRange(this)" id="descripcion" name="descripcion" type="text" class="materialize-textarea" data-length="300" cols="15" rows="15" placeholder="" required></textarea>

                </div>
            </div>

            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="crear_nota" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                </div>
            </div>





            <div class="col s12 m12 l12">
                <table class="bordered highlight striped" id="tabla_notas" style="width: 100%;" data-step="6" data-intro="En esta tabla encontrar&aacute; los puntos de medicion">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>


            <div class="row" hidden>
                 
                 <div class="col s2">
                     <b>Alertar a:</b>
                 </div>
                 <div class="col s8">
                     <select id="send_to" style="display: block" multiple>
                         <option value="all" selected>TODOS</option>
                         <?php
 
                         foreach ($contenedorUsuarios as $key => $usuario) {
 
                          /*   print_r($key); */
                            echo "<option value=" . $usuario["id"] . ">(" . $usuario["usuario"] . ") ". $usuario["nombre_completo"] . "</option>";
                         }
 
                         ?>
                     </select>
                 </div>
                 <div class="input-field checkboxes_send_to col s2">
                     <label>
                         <input id="check_send" type="checkbox" class="filled-in" />
                         <span>TODOS</span>
                     </label>
                 </div>
             </div>


        </form>
    </div>


    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/notas.js?v=<?php echo VERSION; ?>"></script>
  



</main>
