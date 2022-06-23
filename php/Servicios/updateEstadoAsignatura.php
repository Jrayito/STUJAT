<?php 

    require('../Conexion.php');
    require('../Clases/Usuarios.php');
    require('../Clases/Trayectoria.php');
    require('../Clases/Tutorado.php');
    require('../Clases/Carrera.php');

    $conexion = new Conexion();
    $trayectoria = new Trayectoria();
    $miInformacion = new Tutorado();
    $miCarrera = new Carrera();

    $usuario = $_POST['usuario'];
    $ciclo = $_POST['ciclo'];
    $clave = $_POST['clave'];
    $accion = $_POST['accion'];

    $miInformacion-> miInformacion($conexion, $usuario);
    $miCarrera->consultarCarrera($conexion, $miInformacion->getCarrera());

    $trayectoria->consultarTrayectoria($conexion, $usuario);
    switch ($accion) {
        case '0':
            $trayectoria->setAprobada($conexion, $ciclo, $clave, $usuario);
            break;
        case '1':
            $status = $trayectoria->getEstadoAsignatura($ciclo, $clave);
            if($status[1] < 3){
                $trayectoria->setReprobada($ciclo, $clave);
                if($status[1] == '0'){
                    $trayectoria->addReprobada($status[2], $ciclo, $miCarrera->getCreditosTotales());
                    // asignatura%docente = 0%%alumno=0%accion
                    $trayectoria->setAviso($status[2].'&0&0&0');
                    
                }else if($status[1] == '1'){
                    $trayectoria->setAviso($status[2].'&0&0&1');
                    
                }else if($status[1] == '2'){
                    $trayectoria->setAviso($status[2].'&0&0&2');
                    
                }
            }
            break;
    }

    $trayectoria->actualizarTrayectoria($conexion, $usuario, json_encode($trayectoria->getTrayectoria(), JSON_UNESCAPED_UNICODE));

?>