<?php

    include('../Conexion.php');
    include('../Clases/Asignatura.php');
    include('../Clases/Carrera.php');

    $response = new stdClass();
    $informacion = new stdClass();
    $datos = [];
    $datosA = [];
    $datosC = [];
    $areaConocimiento = [];

    $conexion = new Conexion();
    $asignatura = new Asignatura();
    $carrera = new Carrera();

    //Variables de información
    $clave = $_POST['clave'];
    
    $sql = "SELECT * FROM asignaturas WHERE clave = '$clave'";

    $datosA = $asignatura->buscarAsignatura($conexion, $sql);
    $informacion->asignatura = $datosA;
    $carrera->consultarCarrera($conexion, $datosA[0]->acro);
    $areaConocimiento = $carrera->getAreaConocimiento();

    $datosC[0] = $carrera->getnombreCarrera();
    $datosC[1] = $areaConocimiento['data'][$datosA[0]->areaConocimiento - 1]['nombre'];
    $datosC[2] = $carrera->getDivisionAcademica();
    $informacion->carrera = $datosC;

    $informacion->antecedente = $asignatura->consultarAntecedente($conexion, $datosA[0]->antecedente);
    $informacion->subsecuente = $asignatura->consultarSubsecuente($conexion, $datosA[0]->clave);

    $datos[0] = $informacion;
    $response->data = $datos;
    echo json_encode($response);

?>