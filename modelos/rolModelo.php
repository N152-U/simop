<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
class rolModelo extends mainModel
{
    protected function obtener_rol_rol_modelo($rol_id)
    {
        $consulta = "SELECT * FROM roles WHERE id=" . $rol_id . " AND roles.id != 1  AND estatus=1 ORDER BY roles.index_view ASC";


        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }


    protected function obtener_permisos_rol_rol_modelo($rol_id)
    {
        $consulta = "SELECT r.id AS rol_id, r.rol, p.id AS permiso_id, p.leyenda, p.permiso, p.index_view, p.estatus FROM roles r INNER JOIN roles_permisos rp ON r.id=rp.rol_id INNER JOIN permisos p ON p.id=rp.permiso_id WHERE r.id=" . $rol_id . " AND r.estatus=1 ORDER BY p.index_view ASC";


        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }


    protected function obtener_permisos_rol_modelo($rolCuentaUsuario)
    {
      
        $rolCuentaUsuario=$this->decryption($rolCuentaUsuario);
        if($rolCuentaUsuario==1){//Comprobar si el rol del usuario es de administrador
            $consulta = "SELECT * FROM permisos p WHERE p.estatus=1";
        }else{
            $consulta = "SELECT * FROM permisos p WHERE p.estatus=1 AND p.only_admin=0";
        }
        
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function crear_rol_rol_modelo($rolDatos)
    {

        $session_user=$_SESSION[GUID]["usuario"];

        $res = 0;
        
        $consulta1 = "INSERT INTO roles(rol,index_view,created_at,modified_at, created_by, modified_by) VALUES (:rol,(SELECT r.id+1 FROM roles r ORDER BY r.id DESC LIMIT 1),NOW(),NOW(), :created_by, :modified_by)";

        $consulta2 = "INSERT INTO roles_permisos(rol_id,permiso_id,assigned_by) VALUES (:rol_id,:permiso_id,:assigned_by)";

        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(":rol" => $rolDatos["rol"], ":created_by"=>$session_user, ':modified_by'=>$session_user));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            if ($codigos[1] != null) {
                print_r($codigos);
                $res = -1;
            } else {

                $rol_id = $pdo->lastInsertId();
                foreach ($rolDatos["permiso_id"] as $index => $value) {
                    $stmt = $pdo->prepare($consulta2);
                    $stmt->execute(array(":rol_id" => $rol_id, ":permiso_id" => $index, ":assigned_by"=>$session_user));
                    $stmt->closeCursor();
                    $codigos = $stmt->errorInfo();

                    if ($codigos[1] != null) {
                        print_r($codigos);
                        $res = -1;
                        break;
                    }
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


    protected function editar_rol_rol_modelo($rolDatos)
    {
        $session_user=$_SESSION[GUID]["usuario"];

        $res = 0;
        $consulta1 = "UPDATE roles SET rol=:rol, modified_at=NOW(), modified_by=:modified_by WHERE id=:rol_id";

        $consulta2 = "DELETE FROM roles_permisos WHERE rol_id=:rol_id";

        $consulta3 = "INSERT INTO roles_permisos(rol_id,permiso_id, assigned_by) VALUES (:rol_id,:permiso_id,:assigned_by)";

        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(":rol" => $rolDatos["rol"], ":rol_id" => $rolDatos["rol_id"], ":modified_by" => $session_user));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            if ($codigos[1] != null) {
                print_r($codigos);
                $res = -1;
            } else {
                $stmt = $pdo->prepare($consulta2);
                $stmt->execute(array(":rol_id" => $rolDatos["rol_id"]));
                $stmt->closeCursor();
                $codigos = $stmt->errorInfo();
                foreach ($rolDatos["permiso_id"] as $index => $value) {
                    $stmt = $pdo->prepare($consulta3);
                    $stmt->execute(array(":rol_id" => $rolDatos["rol_id"], ":permiso_id" => $index, ":assigned_by"=> $session_user));
                    $stmt->closeCursor();
                    $codigos = $stmt->errorInfo();

                    if ($codigos[1] != null) {
                        print_r($codigos);
                        $res = -1;
                        break;
                    }
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

    protected function actualiza_estatus_rol_rol_modelo($estatus,$rol_id)
    {

        $res = 0;
        $consulta1 = "UPDATE roles SET estatus=:estatus , modified_at=NOW() WHERE id=:rol_id";
        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(":estatus" =>chr($estatus),":rol_id" => $rol_id));
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
