<?php
    
    session_start();
    // Se valida que la sesion exista y que el rol no sea diferente a administrador
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin'){
        header('location: ../../Login/');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva asignatura</title>
</head>
<body style="background-color: #F3F3F3;">
    <header></header>

    <div class="contenedor" style="margin-top: 30px;">
        <h4>REGISTRO NUEVA ASIGNATURA</h4>
        <div class="form-nueva-asignatura">
            <div class="alerta"></div>
            <form enctype="multipart/form-data" id="form-re-asignatura">
                <h3>INFORMACIÓN GENERAL</h3>

                <input type="radio" name="tipo-asignatura" id="obligatoria" value="obligatoria">
                <label for="obligatoria" class="input-rc" >Obligatoria</label>
                <input type="radio" name="tipo-asignatura" id="optativa" value="optativa">
                <label for="optativa" class="input-rc" >Optativa</label>
                <input type="radio" name="tipo-asignatura" id="especial" value="especial">
                <label for="especial" class="input-rc" title="Ej. SS, PP, Optativas, etc">Asignatura especial</label>

               <div>
                    <input type="checkbox" name="ciclo" id="impartir">
                    <label for="impartir" class="input-rc check">¿Impartir en ciclo corto?</label>
               </div>

                <div class="content-input-text">
                    <div class="input-pequeno">
                        <label>Clave</label>
                        <input type="text" class="input-full" id="clave" name="clave">
                    </div>
                    <div class="input-mp">
                        <label >Nombre</label>
                        <input type="text" class="input-full" id="nombre" name="nombre">
                    </div>
                    <div class="input-pequeno">
                        <label >Horas teóricas</label>
                        <input type="number" class="input-full" id="teoricas" name="teoricas">
                    </div>
                    <div class="input-pequeno">
                        <label >Horas prácticas</label>
                        <input type="number" class="input-full" id="practicas" name="practicas">
                    </div>
                    <div class="input-pequeno">
                        <label>Créditos</label>
                        <input type="number" class="input-full" id="creditos" name="creditos">
                    </div>

                    <select class="input-pequeno" id="optativas" name="optativas">
                        <option value="0">Optativa</option>
                    </select>
                    <select class="input-pequeno" id="academica" name="academica">
                        <option value="0">División Académica</option>
                    </select>
                    <select class="input-pequeno" id="carrera" name="carrera">
                        <option value="0">Carrera</option>
                    </select>
                    <select class="input-pequeno" id="areaConocimiento" name="conocimiento">
                        <option value="0">Area de conocimiento</option>
                    </select>
                    <select class="input-pequeno" id="areaFormacion" name="areaFormacion">
                        <option value="0">Área de formación</option>
                    </select>
                    
                    <input type="text" class="input-pequeno" placeholder="¿Antecedente? Escribe clave asignatura..." id="subsecuente" name="subsecuente">
                    <p id="asignatura-asignada"></p>                
                   
                    <input type="file" name="file[]" id="file">
                    <input type="button" value="Guardar" class="btn btn-success" id="guardar-asignatura">
                </div>
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
    <script src="../../scripts/DOM-Asignatura.js"></script>
</body>
</html>