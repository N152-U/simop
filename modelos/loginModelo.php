<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
// PRUEBA
    class loginModelo extends mainModel{
        protected function iniciar_sesion_login_modelo($datos){
            //$sql= mainModel::conectar()->prepare("select * from usuarios inner join tipo_usuarios on tipo_usuarios.id=tipo_usuario_id where usuario =:s and pwd =:b limit 1;");
            $sql= mainModel::conectar()->prepare("SELECT u.id, u.usuario, CONCAT_WS(' ',u.nombre,u.ap,u.am) AS nombre, u.pwd, r.rol, r.id as rol_id FROM usuarios u INNER JOIN roles r ON r.id=u.rol_id WHERE u.usuario ='".$datos["usuario"]."' AND u.pwd='".$datos["pwd"]."' AND u.estatus=1 LIMIT 1");
            $sql->bindParam(":s",$datos['usuario']);
            $sql->bindParam(":b",$datos['pwd']);
            $sql->execute();
            
 //          print_r($sql->errorInfo());
//              print_r($sql);
            return $sql;
        }        
        protected function cerrar_sesion_login_modelo($datos)
        {
        //     $sql = self::conectar()->prepare("UPDATE bitacoras SET modified_day=now() WHERE usuario=:usuario AND bcodigo=:bcodigo AND usuario_tipo=:usuario_tipo");
        //     $sql->bindParam(":usuario", $datos['usuario']);
        //     $sql->bindParam(":bcodigo", $datos['bcodigo']);
        //     $sql->bindParam(":usuario_tipo", $datos['privilegio']);
        //     $sql->execute();
        //    print_r($sql->errorInfo());
        //     return $sql;


        }      
        
        protected function consulta_permisos_login_modelo($datos)
        {
        //     $sql = self::conectar()->prepare("UPDATE bitacoras SET modified_day=now() WHERE usuario=:usuario AND bcodigo=:bcodigo AND usuario_tipo=:usuario_tipo");
        //     $sql->bindParam(":usuario", $datos['usuario']);
        //     $sql->bindParam(":bcodigo", $datos['bcodigo']);
        //     $sql->bindParam(":usuario_tipo", $datos['privilegio']);
        //     $sql->execute();
        //    print_r($sql->errorInfo());
        //     return $sql;


        }      

        protected function actualizar_login_usuario_login_modelo()
        {
            $consulta1 = "UPDATE usuarios SET fecha_hora_login=now(), ip_login=:ip_login WHERE id=:usuario_id";
            $pdo = mainModel::conectar();
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare($consulta1);
                $stmt->execute(array(":ip_login" => $_SESSION[GUID]["ip"], ":usuario_id" => mainModel::decryption($_SESSION[GUID]["id"])));
                $codigos = $stmt->errorInfo();
                switch ($codigos[1]) {
                    case null:
    
                        $pdo->commit();
                        //Se ingresaron
                        $res = 0;
                        break;
                    default:
    
                        $pdo->rollBack();
                        //Error
                        print_r($codigos[1]);
                        $res = -1;
                        break;
                }
            } catch (PDOException $e) {
                $pdo->rollBack();
                die($e->getMessage());
                //Error
                $res = -1;
            }
            return $res;
            /*
            $res
            -1 Ocurrio un Error 
            0 Se actualizo el login
            */
        }

    }