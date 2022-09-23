<?php
    include('../../../php/Conexion.php');
    include('../../../php/Clases/Trayectoria.php');
    require('../../../php/Sesion.php');

    session_start();
    
    $conexion = new Conexion();
    $trayectoria = new Trayectoria();
    $sesion = new Sesion();
    
    $sesion->comprobarInactividad();
    // Se valida que la sesion exista y que el rol no sea diferente a administrador
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin'){
        header('location: ../../Login/');
        exit;
    }
    $returnURL = 'Administrador/carrera.php';
    $url = '../trayectoria.php?returnUrl='.$returnURL.'&carrera='.$_GET['carrera'];
    
    if(isset($_GET['carrera'])){
        $resultado = $trayectoria->consultarTrayectoria($conexion, $_GET['carrera']);
        if(!isset($resultado->json)){
          $url .= '&trayectoria=null' ;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Carrera</title>
</head>

<body style="background-color: #F3F3F3;">
    <header></header>

    <div class="contenedor">
        <h4>INFORMACIÓN</h4>
        <div class="carrera">
            <?php
                if(!isset($resultado->json)){
                    echo '<div class="no-trayectoria">Aviso: Es necesario configurar una trayectoria académica</div>';
                }  
            ?>
           
            <div class="alerta"></div>
            <!-- <div class="opciones">
                <button class="btn btn-edit"><i class="material-icons">edit</i>Editar</button>
                <button class="btn btn-delete"><i class="material-icons">delete</i>Eliminar</button>
            </div> -->
            <div class="informacion-carrera">
                <div class="trayectoria">
                    <a href="<?php echo $url ?>">
                        <img src="../../recursos/icone-fichier-document-noir.png" alt="">
                        Gestionar trayectoria</a>
                </div>
                <div class="info-tabla-carrera">
                    <table>
                        <tbody>
                            <tr>
                                <td style="font-weight: bold;">Carrera</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">División académica</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Créditos</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="guardar">
                <button class="btn btn-success" id="guardar-carrera"><i class="material-icons">save</i>Guardar</button>
            </div> -->
            <div class="asignaturas-carrera">
                <h3>Áreas de Conocimiento</h3>
                <div class="areas-conocimiento">

                </div>
                <h3>Asignaturas</h3>
                <div class="listado-asignaturas">
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
        </script>
    <script src="../../scripts/Templete.js"></script>
    <script src="../../scripts/Main.js"></script>
    <script>cargarTemplete('');</script>
    <script src="../../scripts/DOM-Consultar-Carrera.js"></script>
</body>

</html>