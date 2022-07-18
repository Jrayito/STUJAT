<?phpdate_default_timezone_set('America/Mexico_City');

    session_start();

    // Se define la hora de acceso
        
    $_SESSION['acceso'] = Date('Y-n-j h:i:s');
    header('Location: aplication.php');


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