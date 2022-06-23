<?php
    session_start();
    include('../../php/Conexion.php');
    include('../../php/Clases/Asignatura.php');
    include('../../php/Clases/Carrera.php');
    include('../../php/Clases/Trayectoria.php');

    $areasFormacion = array('General', 'Sustantiva Profesional', 'Integral Profesional', 'Transversal');
    $optativas = array(
        'Entorno Social', 
        'Matemáticas', 
        'Redes', 
        'Software de Base', 
        'Programación e Ingeniería de Software');
    $colores = array('#f8bbd0', '#e1bee7', '#c5cae9', '#bbdefb', '#c8e6c9', '#f0f4c3', '#ffe0b2', '#ffccbc', '#b2dfdb');
    $border = array('#ec407a', '#ab47bc', '#5c6bc0', '#42a5f5', '#66bb6a', '#d4e157', '#ffa726', '#ff7043', '#26a69a');


    $conexion = new Conexion();
    $asignatura = new Asignatura();
    $carrera = new Carrera();
    $trayectoria = new Trayectoria();

    
    $subsecuente = [];
    $sql = "SELECT * FROM asignaturas WHERE nombre = '{$_GET['asignatura']}'";
    $row = $asignatura->buscarAsignatura($conexion, $sql);

    if($row[0]->antecedente != ''){
        $antecedente = $asignatura->consultarAntecedente($conexion, $row[0]->antecedente);
    }
    $subsecuente = $asignatura->consultarSubsecuente($conexion, $row[0]->clave);
    
    $infoCarrera = $carrera->consultarCarrera($conexion, $row[0]->acro);
    $json = $carrera->getAreaConocimiento();

    $infoTrayectoria = $trayectoria->consultarTrayectoria($conexion, $_GET['u']);
    $status = $trayectoria->getEstadoAsignatura($_GET['c'], $row[0]->clave);
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Asignatura</title>

</head>
<body style="background-color: #F3F3F3;" class="open-modal">
    <header></header>
    
    <div class="informacion-asignatura">
        <?php 
        if(isset($_SESSION['rol'])){
            if(($_SESSION['rol'] == 'alumno' && $_SESSION['usuario'] == $_GET['u']) && $status != null && intval($status[0]) != 1){ ?>
                <div class="opciones" data-carrera="<?php echo $row[0]->acro?>">
                    <button class="btn btn-edit" id="btn-aprobar" value="<?php echo $row[0]->clave?>"><i class="material-icons">check</i>Aprobada</button>
                    <button class="btn btn-delete" id="btn-reprobar" value="<?php echo $row[0]->clave?>"><i class="material-icons">close</i>Reprobada</button>
                </div>
            <?php } ?>
            <span><?php 
                    if($status != null)
                        echo $status[0] ? 'Asignatura aprobada' :  'Reprobada '.$status[1].' ocaciones';   
                    ?>
            </span>
        <?php } ?>

        <p><?php echo $row[0]->clave.' - '. $row[0]->nombre ?></p>
        <table>
            <tbody>
            <tr>
                    <td>Horas teoricas</td>
                    <td>Horas Prácticas</td>
                    <td>Créditos</td>
                </tr>
                <tr>
                    <td><?php echo $row[0]->teoricas  ?></td>
                    <td><?php echo $row[0]->practicas  ?></td>
                    <td><?php echo $row[0]->creditos  ?></td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td>Tipo</td>
                    <td colspan="2"><?php echo $row[0]->tipo  ?></td>
                </tr>
                <tr>
                    <td>Area de formación</td>
                    <td colspan="2">
                        <?php echo $areasFormacion[($row[0]->areaFormacion)-1]?>
                    </td>
                </tr>
                <tr>
                    <td>Área de conocimiento</td>
                    <td colspan="2"><?php 
                        echo $json['data'][($row[0]->areaConocimiento)-1]['nombre'];
                        
                        ?>
                    </td>
                </tr>
                <tr><td colspan="3">Asignatura antecedente</td></tr>
                <tr><td colspan="3"><?php echo (isset($antecedente->clave)) ? $antecedente->nombre : 'Ninguna' ?></td></tr>
                <tr><td colspan="3">Asignatura subcecuente</td></tr>
                <tr><td colspan="3"><?php echo (isset($subsecuente->clave)) ? $subsecuente->nombre : 'Ninguna' ?></td></tr>
            </tbody>
        </table>
        <?php 
            if($row[0]->pdf != ''){
                echo "<a href='../../php/Archivos/".$_GET['asignatura'].".pdf' download><i class='material-icons'>attach_file</i>Descargar información aqui.</a>";
            }else{
                echo "<p>Sin información disponible.</p>";
            }
        ?>
        
    </div>

    
        <div class="pdf">
        <?php if($row[0]->pdf != ''){ ?> 
                <embed src="../../php/Archivos/<?php echo $_GET['asignatura']?>.pdf#toolbar=0&navpanes=0&scrollbar=0   " type="application/pdf"   height="" width="75%">
            <?php }else{ ?>
                <div>
                    <p>Asignaturas disponibles:</p>
                    <?php
                    $indice = array_search($json['data'][($row[0]->areaConocimiento)-1]['nombre'], $optativas, false);
                    if($indice+1 && ($row[0]->clave != 'F1098' && $row[0]->clave != 'F1099')){
                        $sql = "SELECT * FROM asignaturas WHERE optativa = $indice + 1";
                        $resulOptativas = $asignatura->buscarAsignatura($conexion, $sql);
                        $color = $resulOptativas[0]->areaConocimiento;
                        $length = count($resulOptativas);
                        for ($i=0; $i < $length; $i++) {
                            echo '<div class="asignaturas" style="background-color: '.$colores[$color - 1].';border: 2px solid '.$border[$color - 1].';">';
                            echo '<p>'.$resulOptativas[$i]->nombre.'</p>';
                            echo '<i class="material-icons">arrow_forward</i>';
                            echo '</div>';
                        }
                    }else{
                        echo '<p><b>No hay informacion registrada</b></p>';
                    }
                    
                    ?>
                </div>
            <?php } ?>
        </div>

    <script  
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="../scripts/Templete.js"></script>
    <script src="../scripts/Main.js"></script>
    <script src="../scripts/DOM-Consultar-Asignatura.js"></script>
    <script>cargarTemplete('')</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</body>
</html>