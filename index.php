<?php

    require "functions.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    include 'DbConnect.php';
    // Se crea el objeto de conexión 
    $objDb = new DbConnect;
    // Se conecta con la base de datos
    $conn = $objDb->connect();
    
    // Se obtiene el método utilizado para el request HTTP
    $method = $_SERVER['REQUEST_METHOD'];

    // Se obtiene la URI del request
    $path = explode('/', $_SERVER['REQUEST_URI']);

    switch($method){
        case "GET":

            // Si el URI contiene informacion especifica
            if(isset($path[2]) && $path[2] == 'usuarios'){
                $users = obtener_usuarios($conn);
                echo json_encode($users);
            // Si hay un error se devuelve el mansaje de error
            }else if(isset($path[2]) && $path[2] == 'obtener_usuario_a_editar' && isset($path[3]) && is_numeric($path[3])){
                $user = obtener_usuario_a_editar($conn, $path[3]);
                echo json_encode($user);
            }else{
                echo "Error en el metodo GET"; 
            }
            break;

        case "POST":
            if(isset($path[2]) && $path[2] == 'crear_usuario'){
                $response = crear_usuario($conn);
                echo json_encode($response);
            }else if(isset($path[2]) && $path[2] === 'autenticar_usuario'){
                $usuario = autenticar_usuario($conn);
                echo json_encode($usuario);
            }else{
                echo "Error en el metodo POST";
            }
            break;

        case "PUT":
            if(isset($path[2]) && $path[2] == 'editar_usuario'){
                $response = editar_usuario($conn);
                echo json_encode($response);
            }
                
            break;
        case "DELETE":

            if(isset($path[2]) && $path[2] == 'eliminar_usuario' && isset($path[3]) && is_numeric($path[3])){
                $response = eliminar_usuario($conn, $path[3]);
                echo json_encode($response);
            }else{
                echo "Error en el metodo DELETE";
            }
            break;
    }

?>
