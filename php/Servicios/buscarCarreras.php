<?php 

// MODIFICADO - ADAPTAR TODO EL SISTEMA A ESTE SCRIPT
    include('../Conexion.php');
    include('../Clases/Carrera.php');

    $conexion = new Conexion();
    $carrera = new Carrera();

    $response = new stdClass();

    $identificador = $_POST['nombre'];

    $response->data = $carrera->buscarCarrera($conexion, $identificador);
    echo json_encode($response);
?>