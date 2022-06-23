<?php

    session_start();
    include('../Conexion.php');
    include('../Clases/Trayectoria.php');


    $index = $_POST['index'];
    $usuario = $_POST['usuario'];
    $rol = $_SESSION['rol'];

    $conexion = new Conexion();
    $miTrayectoria = new Trayectoria();

    $miTrayectoria->consultarTrayectoria($conexion, $usuario);
    $miTrayectoria->marcarMensaje($conexion, $usuario, $rol, $index);
?>