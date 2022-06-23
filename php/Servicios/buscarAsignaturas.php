<?php 
    include('../Conexion.php');
    include('../Clases/Asignatura.php');

    $conexion = new Conexion();
    $asignatura= new Asignatura();

    $response = new stdClass();

    $key = $_POST['nombre'];

    $sql = "SELECT a.*, c.nombre as carreraFull
            FROM asignaturas as a, carreras as c
            WHERE (a.nombre LIKE '%$key%' OR clave = '$key' OR carrera = '$key')
            AND a.carrera = c.id";

    $response->data = $asignatura->buscarAsignatura($conexion, $sql);
    echo json_encode($response);
?>