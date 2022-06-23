<?php
    include('../Conexion.php');
    include('../Clases/Carrera.php');

    $conexion = new Conexion();
    $carrera = new Carrera();

    $nombre = $_POST['nombre'];
    $acronimo = $_POST['acronimo'];
    $creditos = $_POST['creditos'];
    $academica = $_POST['academica'];
    $json = json_decode(json_encode($_POST['conocimiento']));

    $resultado = $carrera->guardarCarrera($conexion, $acronimo, $nombre, $creditos, 
                        $academica, json_encode($json, JSON_UNESCAPED_UNICODE));

    if($resultado == 'error'){
        echo 'error';
        exit;
    }


    echo 'ok';
?>