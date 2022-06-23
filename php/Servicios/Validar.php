<?php

    require('../Conexion.php');
    require('../Clases/Usuarios.php');
    require('../Sesion.php');

    $conexion = new Conexion();
    $us = new Usuarios();
    $sesion = new Sesion();

    // Se recuperan las variables
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $tabla = $_POST['tabla'];

    $rows = $us->validarUsuario($conexion, $tabla, $usuario, $contrasena);

    if($rows == 0){
        echo 'error';
        exit;
    }

    $sesion->guardarSesion($rows['usuario'], $rows['rol']);
    echo $rows['rol'];
?>