<?php
    session_start();
    include('../../php/Conexion.php');
    include('../../php/Clases/Carrera.php');

    $colores = Array('#f8bbd0', '#e1bee7', '#c5cae9', '#bbdefb', '#c8e6c9', '#f0f4c3', '#ffe0b2', '#ffccbc', '#b2dfdb');

    $conexion = new Conexion();
    $carrera = new Carrera();
    // $rol = $_SESSION['rol'];
    $carrera->consultarCarrera($conexion, $_GET['carrera']);
    $areasConocimiento = $carrera->getAreaConocimiento();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        const rolUsuario = '<?php echo isset($_SESSION['rol']) ? $_SESSION['rol'] : null; ?>';
        const user = '<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null; ?>';
    </script>
    <title>Trayectoria</title>
</head>
<body style="background-color: #F3F3F3;">
    <div style="width: 95%; margin: auto;">
        <div class="opciones">
            
            <?php
                $trayectoria_alumno = isset($_GET['alumno']) ? $_GET['alumno'] : 0;
                function btnAcciones (){
                    echo '<button id="guardar-trayectoria" class="btn btn-success"><i class="material-icons">save</i>Guardar</button>';
                    echo '<button id="update-trayectoria" class="btn btn-edit"><i class="material-icons">edit</i>Editar</button>';
                    echo '<button id="nueva-trayectoria" class="btn btn-add"><i class="material-icons">file_upload</i>Nueva trayectoria</button>';
                }

                function Notify (){
                    echo '<div class="avisos-asignaturas">';
                    echo '<button class="info-asignaturas"><i class="material-icons">info</i></button>';
                    echo '<span class="notify">0</span>';
                    echo '</div>';
                }                
            // Se valida que exista una sesión o que la trayectoria que se visualiza pertencezca al mismo usuario en sesión
                if(isset($_SESSION['usuario'])){
                    if($_SESSION['rol'] == 'alumno'){
                        if($_SESSION['usuario'] == $trayectoria_alumno){
                            Notify();
                            btnAcciones();
                        }
                    }
                    if($_SESSION['rol'] == 'docente'){
                        Notify();
                    }
                    
                    if($_SESSION['rol'] == 'admin' && !isset($_GET['alumno'])){
                        btnAcciones();
                    }
                }
            ?>
            <button id="remover-asignaturas" class="btn btn-delete"><i class="material-icons">delete</i>Remover asignatura</button>
            <h5><?php echo $carrera->getnombreCarrera() ?></h5>
        </div>
        <div class="alerta"></div>
    </div>
    
    <div class="content-trayectoria">
        
        <button class="btn" title="Nuevo ciclo" id="add-ciclo"><i class="material-icons">add</i></button>
    </div>


    <div class="modal">
        
        <div class="modal-content" style="width: 40%; margin-top: 90px;">
            <button><i class="material-icons">close</i></button>
            <div class="buscar-asignatura">
                <input 
                    type="text" 
                    placeholder="Buscar asignatura..." 
                    id="search-asignatura"
                    autocomplete="off"
                >
                
                <select id="opciones-busqueda" class="input-pequeno">
                    <option value="0">Opciones de busqueda</option>
                    <option value="9">Asignaturas restantes</option>
                    <option value="10">Disponible ciclo corto</option>
                    <?php 
                        foreach($areasConocimiento['data'] as $area){
                            echo '<option value="'.$area['id'].'">'.$area['nombre'].'</option>';
                        }

                    ?>
                </select>
            </div>
            <div class="resultado-asignaturas">
                
            </div>
            <h3>Asignatura(s) sugeridas</h3>
            <div class="asignaturas-sugerencia">
                
            </div>
        </div>
    </div>

    <div class="modal-informacion">
        <div class="modal-content">
        <button><i class="material-icons">close</i></button>
            <div>
                <h2>Información de colores</h2>
                <div class="info-areas-formacion">
                    <div class="area-formacion">
                        <span style="background-color: #e0e0e0;"></span>
                        <p>Asignatura aprobada</p>
                    </div>
                    <?php 
                        
                        foreach($areasConocimiento['data'] as $area){
                            echo '<div class="area-formacion">';
                            echo '<span style="background-color:'.$colores[$area['id'] - 1].';"></span>';
                            echo '<p>'.$area['nombre'].'</p>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
            <div>
                <h2>Avisos</h2>
                <div class="info-avisos">
                    <a href="#reglamento">Ver Reglamento Escolar</a>
                </div>
            </div>
        </div>
    </div>
    <script  
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script> -->
    <script src="../scripts/Templete.js"></script>
    <script src="../scripts/Main.js"></script>
    <script src="../scripts/Interfaz.js"></script>
    <script>cargarTemplete('')</script>

    
    <script src="../scripts/DOM-Trayectoria.js"></script>
    <script src="../scripts/Sortable.js"></script>
    
    <script>
        $(document).ready(function(){
            if((rolUsuario == 'docente' || rolUsuario == '') && parametros['alumno'] != user){
                setTimeout(() => {
                    $('.ciclo > select').prop('disabled', true);
                    $('#add-ciclo, .add-asignatura').hide();
                }, 1000);
            }
        });
        
    </script>
</body>
</html>