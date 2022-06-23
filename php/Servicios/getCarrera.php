<?php 

    require('../Conexion.php');
    require('../Clases/Carrera.php');


    $nombre = $_POST['nombre'];

    $conexion = new Conexion();
    $carrera = new Carrera();

    $response = new stdClass();
    $obj = new stdClass();

    $carrera->consultarCarrera($conexion, $nombre);

    $obj->nombre = $carrera->getnombreCarrera();
    $obj->academica = $carrera->getDivisionAcademica();
    $obj->creditos = $carrera->getCreditosTotales();
    $obj->json = $carrera->getAreaConocimiento();

    $datos[0] = $obj;

    $response -> data = $datos;
    echo json_encode($response);

?>