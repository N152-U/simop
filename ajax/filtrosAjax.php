<?php
    $peticionAjax = TRUE;
    session_start();
    require_once "../nucleo/configGeneral.php";
    require_once "../controladores/filtrosControlador.php";
    require_once "../controladores/categoriaControlador.php";
    require_once "../controladores/subcategoriaControlador.php";
    
    $filtrosInstance = new filtrosControlador();
    $categoriaInstance = new categoriaControlador();
    $subcategoriaInstance = new subcategoriaControlador();
   
        if(isset($_POST['subcategoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="EDITAR")){

            $res=$subcategoriaInstance->editar_subcategoria_subcategoria_controlador($_POST);
        
            echo $res;
        }else
        if(isset($_POST['subcategoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="GUARDAR")){

            $res=$subcategoriaInstance->crear_subcategoria_subcategoria_controlador($_POST);
        
            echo $res;
        }else
        if(isset($_POST['categoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="EDITAR")){

            $res=$categoriaInstance->editar_categoria_categoria_controlador($_POST);
        
            echo $res;
        }else
        if(isset($_POST['categoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="GUARDAR")){

            $res=$categoriaInstance->crear_categoria_categoria_controlador($_POST);
        
            echo $res;
        }else
       if(isset($_POST['elementos'])&&isset($_POST['accion'])&&($_POST['accion']=="GUARDAR"))
        {
        
            $res=$subcategoriaInstance->crear_activadores_categoria_controlador($_POST['elementos']);
            echo $res;
        }  
        elseif(isset($_POST['categoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="ELIMINAR"))
        {
        
            $res=$categoriaInstance->eliminar_categoria_categoria_controlador($_POST['categoria_id']);
            echo $res;
        }else if(isset($_POST['subcategoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="BUSCAR")){

            $res=$filtrosInstance->obtener_activadores_filtros_controlador($_POST['subcategoria_id']);
        
            echo json_encode($res);
        }else
        if(isset($_POST['subcategoria_id'])&&isset($_POST['accion'])&&($_POST['accion']=="BUSCAR")){
    
            $res=$filtrosInstance->obtener_activadores_filtros_controlador($_POST['subcategoria_id']);
        
            echo json_encode($res);
        }
  
  
?>
