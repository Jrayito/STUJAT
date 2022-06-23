<?php

    include('./Clases/Carrera.php');
    include('Conexion.php');

    $conexion = new Conexion();

    $usuario = new Carrera();
 
    $resultado = $usuario->guardarCarrera($conexion, 'LSC', 'Sistemas', 341, 'cyti');
    echo json_encode($resultado);