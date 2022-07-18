<?php
    session_start();
    date_default_timezone_set('America/Mexico_City');
    
    $ultimoAcceso = $_SESSION['acceso'];
    $ahora = Date('Y-n-j h:i:s');
    $tiempo_transcurrido = (strtotime($ahora) - strtotime($ultimoAcceso));

    // Se compara el tiempo
    if($tiempo_transcurrido >= 60){
        // se destruye la sesion
        session_destroy();
        echo '<p>Hora de inicio '.$ultimoAcceso.'</p>';
        echo '<p>Hora de termino '.$ahora.'</p>';
        echo '<h1>Sesión terminada por inactividad</h1>';
    }else{
        echo '<p>Hora de inicio'.$ultimoAcceso.'</p>';
        $_SESSION['acceso'] = $ahora;
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
<body>
</body>
</html>