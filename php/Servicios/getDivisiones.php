<?php

    require('../Conexion.php');

    $conexion = new Conexion();
    $con = $conexion->conectarDB();

    $response = new stdClass();
    $datos = [];

    $sql = "SELECT * FROM divisiones";

    $resultado = $con->query($sql);
    
    $i = 0;
    while($row = $resultado->fetch_assoc()){
        $obj = new stdClass();
        $obj->id = $row['id'];
        $obj->nombre = $row['nombre'];
        $datos[$i] = $obj;
        $i++;
    }

    $response->data = $datos;
    echo json_encode($response);
?> 