<?php

    require('../../../php/Conexion.php');
    require('../../../php/Clases/Usuarios.php');
    require('../../../php/Clases/Tutorado.php');
    require('../../../php/Clases/Tutor.php');
    require('../../../php/Clases/Carrera.php');
    require('../../../php/Clases/Trayectoria.php');

    session_start();
    // Se valida que la sesion exista y que el rol no sea diferente a administrador
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'alumno'){
        header('location: ../../Login/');
        exit;
    }

    $conexion = new Conexion();
    $tutorado = new Tutorado();
    $miTutor = new Tutor();
    $miCarrera = new Carrera();
    $miTrayectoria = new Trayectoria();


    $tutorado->miInformacion($conexion, $_SESSION['usuario']);
    $miCarrera->consultarCarrera($conexion, $tutorado->getCarrera());
    $miTrayectoria->consultarTrayectoria($conexion, $_SESSION['usuario']);
    $avance = number_format($miTrayectoria->getAvance($miCarrera->getCreditosTotales()), 2);
    $restante = 100 - $avance;

    $miTutor->getTutor($conexion, $tutorado->getTutor());

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorado</title>
</head>
<body style="background-color: #F3F3F3;">
    <header></header>
    <div class="contenedor">
        <div class="opciones">
            <a href="../../../php/Servicios/terminarSesion.php" class="btn btn-success" id="terminar-sesion">
                <i class="material-icons">exit_to_app</i>Cerrar Sesión
             </a>
            </div>
            <div class="informacion">
            <h5><?php echo $tutorado->getMatricula().' - '.$tutorado->getFullName() ?></h5>
            <div class="informacion-tuturado">
                <div class="trayectoria">
                    <a href="../trayectoria.php?alumno=<?php echo $tutorado->getMatricula() ?>&carrera=<?php echo $tutorado->getCarrera()?>">
                        <img src="../../recursos/icone-fichier-document-noir.png" alt="">
                        Ver trayectoria</a>
                </div>
                <div class="info-tabla-tutorado">
                    <table>
                        <tbody>
                            <tr>
                                <td>División Académica</td>
                                <td><?php echo $tutorado->getDivisionAcademica(); ?></td>
                            </tr>
                            <tr>
                                <td>Carrera</td>
                                <td><?php echo $miCarrera->getnombreCarrera(); ?></td>
                            </tr>
                            <tr>
                                <td>Correo</td>
                                <td><?php echo $tutorado->getCorreo(); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table class="info-creditos">
                <tbody>
                    <tr>
                        <td>Créditos acumulados: <?php echo $miTrayectoria->getcreditosAcumulados() ?></td>
                        <td>Créditos restantes: <?php echo $miTrayectoria->getCreditosRestantes($miCarrera->getCreditosTotales()) ?> </td>
                        <td>Total: <?php echo $miCarrera->getCreditosTotales() ?></td>
                    </tr>
                </tbody>
            </table>
            <span>Avance curricular:</span>
            <div class="avance">
            
                <div style="width: <?php echo $avance?>%">Avance <?php echo $avance?>%</div>
                <div style="width:  <?php echo $restante?>%">Restante <?php echo $restante?>%</div>
            </div>
            <h4>Datos del tutor</h4>
            <table>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo $miTutor->getFullName()?></td>
                    </tr>
                    <tr>
                        <td>División Académica</td>
                        <td><?php echo $miTutor->getDivision()?></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><?php echo $miTutor->getCorreo()?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <script  
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="../../scripts/Templete.js"></script>
    <script>
        cargarTemplete('');
    </script>

</body>
</html>