<?php 
    require('../../../php/Clases/Usuarios.php');
    require('../../../php/Clases/Administrador.php');
    require('../../../php/Conexion.php');
    require('../../../php/Sesion.php');
    
    session_start();
    
    // Se valida que la sesion exista y que el rol no sea diferente a administrador
    $sesion = new Sesion();
    $sesion->comprobarInactividad();
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin'){
        header('location: ../../Login/');
        exit;
    }
    $usuario = $_SESSION['usuario'];

    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $sql = "SELECT doc.*, di.nombre as academica
            FROM docentes as doc, divisiones as di
            WHERE usuario = '$usuario' AND doc.dAcademica = di.id";
    $resultado = $con->query($sql);
    $row = $resultado->fetch_assoc();

    $administrador = new Administrador();
    $administrador->setInformacion($row['nombre'], $row['apellidos'], $row['contrasena'], $row['correo'], $row['academica'], $row['usuario']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | Sistema de trayectorias académicas</title>
</head>

<body style="background-color: #F3F3F3;">
    <header>
        
    </header>
    <div class="toggle-menu">
    <input type="checkbox" name="" id="check-menu">
    <label for="check-menu" id="label-check-menu"> <i class="material-icons">menu</i></label>
    </div>
    <nav>
        <div class="menu-none">
            <div class="img-banner">
                <img src="../../recursos/banner.jpg" alt="">
                <h4><?php echo $administrador->getFullName() ?></h4>
            </div>

            <div class="servicios">
                <span>SERVICIOS</span>
                <ul>
                    <li data='inicio' class="active"><a href="#inicio"><i class="material-icons">home</i>Inicio</a></li>
                    <li data=''><a href="#usuarios"><i class="material-icons">group</i>Usuarios</a></li>
                    <li data=''><a href="#carreras"><i class="material-icons">business</i>Carreras</a></li>
                    <li data=''><a href="#asignaturas"><i class="material-icons">library_books</i>Asignaturas</a></li>
                </ul>
            </div>
            <a href="../../../php/Servicios/terminarSesion.php" class="btn btn-success" id="terminar-sesion">
                <i class="material-icons">exit_to_app</i>Cerrar Sesión
            </a>
        </div>
    </nav>

    <main>
        <h3></h3>
        <div>
            <div class="opciones">
                <a class="btn btn-add" href="">Agregar usuario</a>
            </div>
            <div class="alerta"></div>
            <div class="buscador">
                <input type="text" placeholder="Buscar usuario..." class="input-medio">
                <select>
                </select>
            </div>

            <div class="tabla-buscador">
                <table>
                    <thead>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>

    <!-- Footer de la pàgina  -->
    <footer>
        <span>Av. Universidad s/n, Zona de la Cultura, Col. Magisterial, Vhsa, Centro, Tabasco, Mex. C.P. 86040. Tel (993) 358 15 00</span>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
    </script>
    <script src="../../scripts/Templete.js"></script>
    <script>

    $('#check-menu').change(function(){
        if($('#label-check-menu').css('display') == 'block'){
            $(this).is(':checked') 
                ? $('nav').animate({'margin-left': '0'}, 'normal')
                : $('nav').animate({'margin-left': '-500px'}, 'normal')
        }
    });

    </script>

    <script>cargarTemplete('');</script>
    <script src="../../scripts/Interfaz.js"></script>
    <script src="../../scripts/Main.js"></script>
    <script src="../../scripts/DOM-AD.js"></script>

</body>

</html>