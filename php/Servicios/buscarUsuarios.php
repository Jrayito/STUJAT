<?php 
    include('../Conexion.php');
    include('../Clases/Usuarios.php');
    include('../Clases/Administrador.php');

    $response = new stdClass();
    $datos = [];

    $conexion = new Conexion();
    $administrador = new Administrador();


    $nombre = $_POST['nombre'];
    $tabla = $_POST['type'];

    $response->data = $administrador->buscarUsuario($conexion, $nombre, $tabla);
    echo json_encode($response);
 ?>