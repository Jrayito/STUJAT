<?php

    require('../Conexion.php');
    require('../Clases/Usuarios.php');
    require('../Clases/Tutorado.php');
    require('../Clases/Carrera.php');
    require('../Clases/Trayectoria.php');


    $response = new stdClass();
    $datos = [];

    $conexion = new Conexion();
    $tutorado = new Tutorado();
    $miCarrera = new Carrera();
    $miTrayectoria = new Trayectoria();

    $matricula = $_POST['tutorado'];

    $tutorado->miInformacion($conexion, $matricula);
    $miCarrera->consultarCarrera($conexion, $tutorado->getCarrera());
    $miTrayectoria->consultarTrayectoria($conexion, $matricula);
    $avance = number_format($miTrayectoria->getAvance($miCarrera->getCreditosTotales()), 2);
    $restante = 100 - $avance;

    $obj = new stdClass();

    $obj->matricula = $tutorado->getMatricula();
    $obj->Acarrera = $tutorado->getCarrera();
    $obj->nombre = $tutorado->getFullName();
    $obj->academica = $tutorado->getDivisionAcademica();
    $obj->correo = $tutorado->getCorreo();
    $obj->carrera = $miCarrera->getnombreCarrera();
    $obj->avance = $avance;
    $obj->restante = $restante;
    $obj->lista = $miTrayectoria->getListaReprobadas();
    $obj->countMsm = $miTrayectoria->getCountMsm();
    $datos[0] = $obj;

    $response -> data = $datos;
    echo json_encode($response);

?>