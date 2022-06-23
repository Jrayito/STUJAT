<?php

    require('../Conexion.php');
    require('../Clases/Asignatura.php');

    $conexion = new Conexion();
    $asig = new Asignatura();

    //VARIABLES DE DATOS
    $optativa = 0; 
    $ciclo = 0;
    $teoricas = 0;
    $src = '';
    $antecedente = '';

    $type = $_POST['tipo-asignatura'];
    $clave = $_POST['clave'];
    $asignatura = $_POST['nombre'];
    
    if($_POST['teoricas'] != null){
        $teoricas = $_POST['teoricas'];
    }

    $practicas = $_POST['practicas'];
    $creditos = $_POST['creditos'];
    if(isset($_POST['optativas'])){
        $optativa = $_POST['optativas'];
    }
    $carrera = $_POST['carrera'];
    $areaFormacion = $_POST['areaFormacion'];
    $areaConocimiento = $_POST['conocimiento'];

    if(isset($_POST['subsecuente'])){
        $antecedente = $_POST['subsecuente'];
    }
    
    if(isset($_POST['ciclo'])){
        $ciclo = $_POST['ciclo'];
    }

    if(isset($_FILES['file'])){
        $file = $_FILES["file"];
        $ruta = $file["tmp_name"][0];
        $src = "../Archivos/".$asignatura.".pdf";
        move_uploaded_file($ruta, $src);
    }

    $asig->setInformacion($asignatura, $clave, $teoricas, $practicas, $creditos, $type, $areaFormacion, $areaConocimiento ,$antecedente, $optativa, $carrera, $src, $ciclo);
    $resultado = $asig->guardarAsignatura($conexion);

    if($resultado == 0){
        echo 'exist';
        exit;
    }

    if($resultado == 'error'){
        echo 'error';
        exit;
    }

    echo "ok";
?>