<?php
    session_start();
    require_once('../../php/Sesion.php');
    $sesion = new Sesion();
    $sesion->comprobarRol();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" href="../estilos/main.css">
    <style>
        body{ 
            background: #CCCCCC url(../recursos/bg.jpg) no-repeat fixed center center;       
            background-size: cover; }
    </style>
    <title>Sistema de trayectorias académicas</title>
</head>
<body>
    <header>
        <div class="contenedor">
            <a href="./index.html"><img src="../recursos/escudo.png" alt="" class="logo"></a>
        </div>
        <div>
            <div class="contenedor">
                <h6>Sistema de trayectorias académicas</h6>
            </div>
        </div>
    </header>
    <div class="formulario">
        <form id="form-login">
            <div class="alerta"></div>
            <input type="text" placeholder="Usuario" class="input-full">
            <input type="password" placeholder="Contraseña" class="input-full">
            <input type="radio" id="alumno" name="usuario" value="alumnos">
            <label for="alumno" class="input-rc">Alumno</label>
            <input type="radio" id="docente" name="usuario" value="docentes">
            <label for="docente" class="input-rc">Docente</label>
            <input type="button" value="Iniciar Sesión" class="btn btn-success" style="margin: 20px auto 0 auto; display: block;" id="iniciar-sesion">
        </form>
    </div>
    <footer>
        <span>Av. Universidad s/n, Zona de la Cultura, Col. Magisterial, Vhsa, Centro, Tabasco, Mex. C.P. 86040. Tel (993) 358 15 00</span>
    </footer>
    <script  
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="../scripts/Templete.js"></script>
    <script src="../scripts/Interfaz.js"></script>
    <script src="../scripts/Main.js"></script>
    <script src="../scripts/DOM.js"></script>
</html>