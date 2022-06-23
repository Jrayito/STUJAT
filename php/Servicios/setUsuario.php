<?php
    include('../Conexion.php');
    include('../Clases/Usuarios.php');
    include('../Clases/Administrador.php');
    include('../Clases/Trayectoria.php');

    $conexion = new Conexion();
    $admin = new Administrador();
    $trayectoria = new Trayectoria();

    // INFORMACION GENERAL DE USUARIO
    $rol = $_POST['rol'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $division = $_POST['division'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if(isset($_POST['tutor'])){
        $carrera = $_POST['carrera'];
        $tutor = $_POST['tutor'];
    }

    $existe = $admin->buscarUsuario($conexion, $usuario, $rol == 'alumno' ? 'alumnos' : 'docentes');

    if(isset($existe[0]->usuario)){
        echo 'duplicado';
        exit;
    }

    $resultado = $rol == 'docente' ?  
                $admin->guardarTutor($conexion, $usuario, $password, $nombre, $apellidos, $correo, $division, $rol) : 
                $admin->guardarTutorado($conexion, $usuario, $password, $nombre, $apellidos, $correo, $carrera, $tutor, $rol, $division);
        
    if($resultado == 'error'){
        echo 'error';
        exit;
    }
    
    if($rol == 'alumno'){
        $infoTrayectoria = $trayectoria->consultarTrayectoria($conexion, $carrera);
        $resultadoT = $trayectoria->guardarTrayectoria($conexion, $usuario, json_encode($infoTrayectoria->json, JSON_UNESCAPED_UNICODE));

        if(!$resultadoT){
            $admin->eliminarUsuario($conexion, $usuario);
            echo 'error';
            exit;
        }
    }
    
    echo 'ok';
?>