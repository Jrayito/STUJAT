<?php
    session_start();
    // SE COMPRUEBA QUE LA SESION NO EXISTE O SI EL ROL ES DIFERENTE 
    // AL USUARIO SE REDIRECCIONA A LA PAGINA DE INICIO
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin'){
        header('Location: ../../');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
</head>
<body style="background-color: #F3F3F3;">
    <header></header>

    <div class="contenedor" style="margin-top: 30px;">
        <h4> <?php echo !isset($_GET['usuario']) ?  'REGISTRO NUEVO USUARIO' : 'INFORMACIÓN USUARIO'?></h4>
        
        <div class="form-nuevo-usuario">
            <!-- <?php if(isset($_GET['usuario'])){?>
            <div class="opciones">
                <button class="btn btn-edit"><i class="material-icons">edit</i>Editar</button>
                <button class="btn btn-delete"><i class="material-icons">delete</i>Eliminar</button>
            </div>
            <?php } ?> -->

            <div class="alerta"></div>
            <form>
                <h3>DATOS PERSONALES</h3>
                <!-- Selecciona el tipo de usuario -->
                <input type="radio" name="usuario" id="alumno" value="alumno">
                <label for="alumno" class="input-rc">Alumno</label>
                <input type="radio" name="usuario" id="docente" value="docente">
                <label for="docente" class="input-rc">Docente</label>
               
                <!-- Informacion personal del usuario -->
                
                <div class="content-input-text">
                    <div class="input-medio">
                        <label class="label-in-block">Nombre(s)</label>
                        <input type="text" class="input-full" id="nombre">
                    </div>
                    <div class="input-medio">
                        <label class="label-in-block">Apellidos</label>
                        <input type="text" class="input-full" id="apellidos">
                    </div>
                    <div class="input-medio">
                        <label class="label-block">Usuario</label>
                        <input type="text" class="input-full" id="usuario">
                    </div>

                    
                    <select class="input-medio" id="academica">
                        <option value="0">División académica</option>
                    </select>
                    <select class="input-medio" id="carrera">
                        <option value="0">Carrera</option>
                    </select>
                </div>
                <!-- Datos de usuario para inicio de sesión -->
                <h3>DATOS DE USUARIO</h3>
                <div class="content-input-text">
                    <div class="input-medio">
                        <label class="label-in-block">Correo</label>
                        <input type="text" disabled class="input-full" id="correo">
                    </div>
                    <div class="input-medio">
                        <label class="label-in-block">Contraseña</label>
                        <input type="text" class="input-full" id="contrasena">
                    </div>
                </div>
                
                
               

                <div class="asignar-tutor">
                    <h3>ASIGNAR TUTOR</h3>
                    <input type="text" class="input-medio" placeholder="Escriba no. Empleado..." id="tutor">
                    <p></p>
                </div>
                <input type="button" value="Guardar" class="btn btn-success" id="guardar">
            </form>
        </div>
    </div>





    <script  
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="../../scripts/Templete.js"></script>
    <script src="../../scripts/Interfaz.js"></script>
    <script src="../../scripts/Main.js"></script>
    <script>cargarTemplete('')</script>
    <script src="../../scripts/DOM-Nuevo-Usuario.js"></script>
</body>
</html>