<?php
    session_start();
    include('../Conexion.php');
    include('../Clases/Asignatura.php');   

    // $optativas = Array('F1491', 'F1492', 'F1493', 'F1494', 'F1495', 'F1496');

    $response = new stdClass();
    $datos = [];

    $conexion = new Conexion();
    $asignatura = new Asignatura();

    $nombre = $_POST['nombre'];
    $cargadas = $_POST['asignaturas'];

    if($_SESSION['rol'] == 'admin'){
        $sql = "SELECT * FROM asignaturas WHERE (nombre LIKE '%$nombre%' OR clave = '$nombre') AND clave NOT IN($cargadas) AND tipo <> 'optativa'";
    }else{
        $sql = "SELECT * FROM asignaturas WHERE (nombre LIKE '%$nombre%' OR clave = '$nombre') AND (clave NOT IN($cargadas) AND optativa = 0)";
    }

    $response->data = $asignatura->consultarAsignaturas($conexion, $sql);
    echo json_encode($response);
?>