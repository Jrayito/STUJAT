<?php
    require('../../../php/Conexion.php');
    require('../../../php/Clases/Usuarios.php');
    require('../../../php/Clases/Tutor.php');
    require('../../../php/Clases/Trayectoria.php');
    require('../../../php/Sesion.php');
    session_start();


    // Se valida que la sesion exista y que el rol no sea diferente a tutor
    if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'docente'){
        $sesion = new Sesion();
        $sesion->terminarSesion();
        // header('location: ../../Login/');
        exit;
    }

    $conexion = new Conexion();
    $tutor = new Tutor();


    $tutor->getTutor($conexion, $_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor</title>
</head>
<body style="background-color: #F3F3F3;"> 
    <header></header>
    <div class="contenedor">
        <div class="opciones">
            <a href="../../../php/Servicios/terminarSesion.php" class="btn btn-success"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a>
        </div>
        <div class="informacion">
            <h5><?php echo $tutor->getFullName()?></h5>
            <table>
                <tbody>
                    <tr>
                        <td>División Académica</td>
                        <td><?php echo $tutor->getDivision()?></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><?php echo $tutor->getCorreo()?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="lista-tutorados"> 
            <h3>Tutorados a cargo</h3>
            <table>
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre(s)</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $misTutorados = $tutor->consultarTutorados($conexion);
                        for ($i=0; $i < count($misTutorados) ; $i++) { 
                            $trayectoria = new Trayectoria();
                            $trayectoria->consultarTrayectoria($conexion, $misTutorados[$i]->matricula);
                            
                            echo '<tr data-tutorado="'.$misTutorados[$i]->matricula.'">';
                            echo ' <td>'.$misTutorados[$i]->matricula.'</td>';
                            echo '<td>'.$misTutorados[$i]->nombre.'</td>';
                            echo '<td>'.$misTutorados[$i]->apellidos.'</td>';
                            echo '<td>'.$misTutorados[$i]->correo.'</td>';
                            echo ($trayectoria->getCountMsm() > 0) 
                                    ? '<td><i class="material-icons" style="color: #b71c1c">warning</i></td>' : '<td></td>';
                            echo '</tr>';
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal">
        <div class="modal-content">
            <button class="close"><i class="material-icons">close</i></button>
            <h5>Información general</h5>
            <div class="informacion-tuturado">
                <div class="trayectoria">
                    <a>
                        <img src="../../recursos/icone-fichier-document-noir.png" alt="">
                        Ver trayectoria
                    </a>
                </div>
                <div class="info-tabla-tutorado">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nombre</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>División Académica</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Carrera</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Correo</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <span>Situación actual</span>
            <!-- <p>El tutorado lleva 331 créditos acumulados de un total de 345</p> -->
            <div class="avance">
                <div></div>
                <div></div>
            </div>
            <div>
                <h2>Asignaturas reprobadas</h2>
                <div class="listado">
                    <div><p>1er ciclo</p></div>
                    <div><p>2do ciclo</p></div>
                    <div><p>3er ciclo</p></div>
                    <div><p>4to ciclo</p></div>
                    <div><p>5to ciclo</p></div>
                </div>
            </div>
        </div>
        
    </div>
    
    <script  
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="../../scripts/templete.js"></script>
    <script>cargarTemplete('')</script>
    <script>

        const aviso = (countMsm) => {
            $('.alerta').remove();
            if(countMsm > 0){
                const div = $('<div/>', {html: 'Se necesita supervisar la trayectoria académica del alumno', class: 'alerta'})
                .css({ 'background': '#ef9a9a', 'color': 'white', 'border-left': '5px solid #f44336'});
                $('.informacion-tuturado').before(div);
            }
        }

        const listadoReprobadas = (listado) =>{
            if((listado.length - 1) == 0){
                $('.listado > div').hide();
                $('.listado').append('<p>No hay asignaturas reprobadas</p>')
            }else{
                $('.listado > p').remove();
                $('.listado > div').show();
                $('.listado').children().children('li').remove();
                for (const key in listado) {
                    $('.listado').children().eq(listado[key].ciclo).append(`<li>${listado[key].nombre}</li>`)
                }
            }
        }

        $('.close').click(function(){
            
            $('.modal-content').removeClass('animate__animated animate__bounceIn');
            $('.modal').css({ opacity: '0', visibility: 'hidden'});
            
        });

        $('.lista-tutorados > table tbody tr').click(function(e){
            const tutorado = $(this).attr('data-tutorado');

            $('body').addClass('open-modal');
            $.ajax({
                url: '../../../php/Servicios/getTutorado.php', type: 'POST', data: {tutorado: tutorado}, 
                success: function(resp){
                    const data = JSON.parse(resp);
                    // Se muestra la informacion en el modal
                    $('.info-tabla-tutorado > table tbody').children().eq(0).children().eq(1).text(data.data[0].nombre);
                    $('.info-tabla-tutorado > table tbody').children().eq(1).children().eq(1).text(data.data[0].academica);
                    $('.info-tabla-tutorado > table tbody').children().eq(2).children().eq(1).text(data.data[0].carrera);
                    $('.info-tabla-tutorado > table tbody').children().eq(3).children().eq(1).text(data.data[0].correo);

                    // Se asigna la dirección para la trayectoria
                    $('.trayectoria > a').attr('href', '../trayectoria.php?alumno='+data.data[0].matricula+'&carrera='+data.data[0].Acarrera);
                    
                    // Mostrar el avance curricular
                    $('.avance').children().eq(0).text(`Avance ${data.data[0].avance}%`).css('width', `${data.data[0].avance}%`);
                    $('.avance').children().eq(1).text(`Restante ${data.data[0].restante}%`).css('width', `${data.data[0].restante}%`);
                    // console.log(data.data.lista)
                    listadoReprobadas(data.data[0].lista);
                    aviso(data.data[0].countMsm);
                }
            });


            $('.modal').css({ opacity: '1', visibility: 'visible'});
            $('.modal-content').addClass('animate__animated animate__bounceIn');
        });



    </script>
</body>
</html>