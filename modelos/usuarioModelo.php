<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
class usuarioModelo extends mainModel
{
    protected function obtener_usuario_usuario_modelo($usuario_id)
    {
        $consulta = "SELECT u.id, u.usuario, u.nombre, u.ap, u.am, u.rol_id, r.rol FROM usuarios u INNER JOIN roles r ON r.id=u.rol_id WHERE u.id=" . $usuario_id . " AND u.rol_id!=1 AND u.estatus=1 LIMIT 1";


        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function obtener_roles_usuario_modelo($estatus)
    {
        $consulta = "SELECT * from roles WHERE roles.id!=1 AND estatus=".$estatus;


        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }


    protected function crear_usuario_usuario_modelo($usuarioDatos)
    {
        $session_user=$_SESSION[GUID]["usuario"];
        $res = 0;
        //Se inserta usuario nuevo con contraseña
        $consulta1 = "INSERT INTO usuarios(
        rol_id,
        usuario,
        pwd,
        nombre,
        ap,
        am,
        created_at,
        modified_at,
        created_by,
        modified_by,
        index_view
        )
        values(
        :rol_id,
        :usuario,
        sha2(:pwd,512),
        :nombre,
        :ap,
        :am,
        now(),
        now(),
        :created_by,
        :modified_by,
        (SELECT id+1 FROM usuarios u ORDER BY u.id DESC LIMIT 1)
        )";


        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $index_view = (int) $stmt->fetchColumn();
            $stmt->closeCursor();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(
                ":rol_id" => $usuarioDatos["rol_id"],
                ":usuario" => $usuarioDatos["usuario"],
                ":pwd" => $usuarioDatos["pwd"],
                ":nombre" => $usuarioDatos["nombre"],
                ":ap" => $usuarioDatos["ap"],
                ":am" => $usuarioDatos["am"],
                ":created_by"=>$session_user,
                ":modified_by"=>$session_user

            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            switch ($codigos[1]) {
                case null:
                    $pdo->commit();
                    //Se ingresaron
                    break;
                default:
                    print_r($codigos);
                    $pdo->rollBack();
                    $res = -1;
                    //Error
                    break;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
            //Error
            $res = -1;
        }
        return $res;
    }


    protected function editar_usuario_usuario_modelo($usuarioDatos)
    {
        $session_user=$_SESSION[GUID]["usuario"];
        //Se actualiza usuario
        $res = 0;
        $consulta = "UPDATE usuarios SET 
        rol_id=:rol_id,
        usuario=:usuario,
        nombre=:nombre,
        ap=:ap,
        am=:am,
        modified_at=now(), modified_by=:modified_by WHERE id=:usuario_id";
        //Se actualiza contraseña
        $consulta1 = "UPDATE usuarios SET 
        pwd=sha2(:pwd,512),
        modified_at=now() WHERE id=:usuario_id";


        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare($consulta);
            $stmt->execute(array(
                ":rol_id" => $usuarioDatos["rol_id"],
                ":usuario" => $usuarioDatos["usuario"],
                ":nombre" => $usuarioDatos["nombre"],
                ":ap" => $usuarioDatos["ap"],
                ":am" => $usuarioDatos["am"],
                ":modified_by" => $session_user,
                ":usuario_id" => $usuarioDatos["usuario_id"]
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            if ($codigos[1] != null) {
                $res = -1;
            } else {
                 //Se actualiza contraseña si el campo no viene vacio
                if ($usuarioDatos["pwd"] != "") {
                    $stmt = $pdo->prepare($consulta1);
                    $stmt->execute(array(
                        ":pwd" => $usuarioDatos["pwd"],
                        ":usuario_id" => $usuarioDatos["usuario_id"],
                    ));
                    $stmt->closeCursor();
                    $codigos = $stmt->errorInfo();
                }
            }

            switch ($codigos[1]) {
                case null:
                    $pdo->commit();
                    //Se ingresaron
                    break;
                default:
                    print_r($codigos);
                    $pdo->rollBack();
                    $res = -1;
                    //Error
                    break;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
            //Error
            $res = -1;
        }
        return $res;
    }

    protected function  actualiza_estatus_usuario_usuario_modelo($estatus,$usuario_id)
    {

        $res = 0;
        $consulta1 = "UPDATE usuarios SET estatus=:estatus, modified_at=NOW() WHERE id=:usuario_id";
        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(":estatus" => chr($estatus),":usuario_id" => $usuario_id));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();

            switch ($codigos[1]) {
                case null:
                    $pdo->commit();
                    //Se ingresaron
                    break;
                default:
                    print_r($codigos);
                    $pdo->rollBack();
                    $res = -1;
                    //Error
                    break;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
            //Error
            $res = -1;
        }
        return $res;
    }

    
}
