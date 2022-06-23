<?php
    session_start();
    include('../Conexion.php');
    include('../Clases/Asignatura.php');   

    $response = new stdClass();
    $datos = [];

    $conexion = new Conexion();
    $asignatura = new Asignatura();

    $index = $_POST['index'];
    $cargadas = $_POST['filtro'];

    $sql = "SELECT* FROM asignaturas WHERE areaConocimiento = $index AND (clave NOT IN ($cargadas) AND optativa = 0)";

    $response->data = $asignatura->consultarAsignaturas($conexion, $sql);
    echo json_encode($response);
?>