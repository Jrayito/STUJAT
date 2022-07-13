<?php

    include('../Conexion.php');
    include('../Clases/Carrera.php');
    include('../Clases/Trayectoria.php');
   
    $conexion = new Conexion();
    $carrera = new Carrera();
    $trayectoria = new Trayectoria();

    // Variables de uso
    $user = $_POST['user'];
    $json = json_decode(json_encode($_POST['json']));
    $creditos = $_POST['creditos'];

    $validarExistencia = $trayectoria->consultarTrayectoria($conexion, $user);

    $carrera->consultarCarrera($conexion, $_POST['carrera']);

    if(!($creditos == $carrera->getCreditosTotales())){
        echo 'error=Trayectoria incompleta, faltan asignaturas por agregar';
        exit;
    }

     // comprobar los créditos minimos de cada ciclo
    foreach($json->ciclos as $ciclo){
        if(!$trayectoria->validarCiclo($ciclo)){
            echo 'error=Los ciclos no cumplen con los créditos minimos requeridos';
            exit;
        }
    }

    if(!isset($validarExistencia->json)){
        if(!$trayectoria->guardarTrayectoria($conexion, $user, json_encode($json, JSON_UNESCAPED_UNICODE))){
            echo "error=No se guardo la trayectoria";
            exit;
        }

        echo "ok=La información se guardo correctamente";
        exit;
    }else{
        if(!$trayectoria->actualizarTrayectoria($conexion, $user, json_encode($json, JSON_UNESCAPED_UNICODE))){
            echo "error=No se guardo la trayectoria";
            exit;
        }

        echo "ok=La informacion se actualizo correctamente";
        exit;
    }

?>
