<?php
    // Función para obtener todos los datos de la base de datos
    function obtener_usuarios($conn){
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    // Función para obtener información del usuasrio a editar de la base de datos
    function obtener_usuario_a_editar($conn, $id){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    // Crear usuarios
    function crear_usuario($conn){
        $user = json_decode(file_get_contents('php://input')); 
        $sql = "INSERT INTO users(id, name, email, clave, mobile) VALUES(null, :name, :email, :clave, :mobile)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':mobile', $user->mobile);
        $stmt->bindParam(':clave', $user->clave);
        if($stmt->execute()){
            $response = ['status'=> 1, 'respuesta'=>'Usuario creado correctamente!'];
        }else{
            $response = ['status'=> 0, 'respuesta'=>'Error al crear usuario!'];
        }
        return $response;
    }

    // Editar un usuario
    function editar_usuario($conn){
        $user = json_decode(file_get_contents('php://input')); 
        $sql = "UPDATE users SET name = :name, email = :email, mobile=:mobile WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $user->id);
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':mobile', $user->mobile);
        if($stmt->execute()){
            $response = ['status'=> 1, 'mensaje'=>'Usuario editado correctamente!'];
        }else{
            $response = ['status'=> 0, 'mensaje'=>'Error al editar usuario!'];
        }
        return $response;
    }
    // Eliminar un usuario por id
    function eliminar_usuario($conn, $id){
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            $response = ['status'=> 1, 'mensaje'=>'Usuario eliminado correctamente!'];
        }else{
            $response = ['status'=> 0, 'mensaje'=>'Error al eliminar usuario!'];
        }
        return $response;
    }
?>