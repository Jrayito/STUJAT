<?php

    include('../Conexion.php');
    include('../Clases/Trayectoria.php');

    $response = new stdClass();

    $conexion = new Conexion();
    $trayectoria = new Trayectoria();

    $idTrayectoria = $_POST['trayectoria'];

    $datos = $trayectoria->consultarTrayectoria($conexion, $idTrayectoria);

    $response->data = $datos;
    echo json_encode($response);

?>