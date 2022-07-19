<?php    

    require('../../../php/Sesion.php');
    session_start();
    
    $sesion = new Sesion();
    $sesion->comprobarInactividad();
    // Se valida que la sesion exista y que el rol no sea diferente a administrador
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin'){
        header('location: ../../Login/');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: #F3F3F3;">
<header></header>

<div class="contenedor">

    <h2>Registro de nueva carrera</h2>
    <div class="form-nueva-carrera">
        <div class="alerta"></div>
                <form>
                    <h3>Informacion general:</h3>
                    <input type="text" 
                        id="nomCarrera" 
                        placeholder="Nombre carrera" 
                        class="input-medio">

                    <input type="text" 
                        id="acronimo" 
                        placeholder="Acronimo" 
                        class="input-mini" 
                        disabled="false" >

                    <input type="text" 
                        id="creditos" 
                        placeholder="Créditos" 
                        class="input-mini">
                    <select id="divisiones" class="input-pequeno">
                        <option value="0">División Académica</option>
                    </select>
                    
                   <div>
                   <h3>Agregar áreas de conocimiento</h3>
                    <input type="text" 
                        id="areaConocimiento" 
                        placeholder="Escriba  el área"  class="input-medio">

                    <div class="areas-conocimiento"></div>
                   </div>
                        


                    <button class="btn btn-success" id="guardar-carrera" disabled>Guardar</button>
                </form>
            </div>
</div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
        </script>
    <script src="../../scripts/Templete.js"></script>
    <script>cargarTemplete('');</script>
    <script src="../../scripts/Interfaz.js"></script>
    <script src="../../scripts/Main.js"></script>
    <script src="../../scripts/DOM-Carrera.js"></script>
</body>
</html>