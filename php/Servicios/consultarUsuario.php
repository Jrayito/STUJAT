<?php 
    include('../Conexion.php');
    include('../Clases/Usuarios.php');
    include('../Clases/Tutor.php');
    include('../Clases/Tutorado.php');
    include('../Clases/Carrera.php');

    $conexion = new Conexion();
    $tutorado = new Tutorado();
    $tutor = new Tutor();
    $carrera = new Carrera();

    $response = new stdClass();
    $informacion = new stdClass();
    $datos = [];

    //Variables de información
    $usuario = $_POST['usuario'];

    if($_POST['tipo'] == '1'){
        $tutorado->miInformacion($conexion, $usuario);
        $tutor->getTutor($conexion, $tutorado->getTutor());
        $informacion->tipo = 'alumno';
        $informacion->nombre = $tutorado->getNombre();
        $informacion->apellidos = $tutorado->getApellidos();
        $informacion->usuario = $tutorado->getMatricula();
        $informacion->academica = $tutorado->getDivisionAcademica();

        $carrera->consultarCarrera($conexion, $tutorado->getCarrera());
        $informacion->carrera = $carrera->getnombreCarrera();
        $informacion->correo = $tutorado->getCorreo();
        $informacion->contrasena = $tutorado->getContrasena();
        $informacion->tutor = $tutor->getFullName();

    }else{
        $tutor->getTutor($conexion, $usuario);
        $informacion->tipo = 'docente';
        $informacion->nombre = $tutor->getNombre();
        $informacion->apellidos = $tutor->getApellidos();
        $informacion->usuario = $tutor->getNoEmpleado();
        $informacion->academica = $tutor->getDivision();
        $informacion->correo = $tutor->getCorreo();
        $informacion->contrasena = $tutor->getContrasena();
    }

    $datos[0] = $informacion;
    $response -> data = $datos;
    echo json_encode($response);
?>