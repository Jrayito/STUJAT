<?php

    class Sesion{

        public function __construct(){
            
        }

        public function guardarSesion($usuario, $rol){
            session_start();
            date_default_timezone_set('America/Mexico_City');

            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $rol;
            $_SESSION['acceso'] = Date('Y-n-j h:i:s');
        }

        public function terminarSesion(){
            session_destroy();
            header('Location: ../../Account/Login/');
        }

        public function comprobarRol(){
            // se comprueba que la sesion existe
            if(isset($_SESSION['usuario'])){
                // se valida que el usuario este en el directorio correspondiente
                switch ($_SESSION['rol']) {
                    case 'admin':
                        header('location: ../../Account/Usuarios/Administrador/');
                        break;
                    case 'docente':
                        header('location: ../../Account/Usuarios/Docente/');
                        break;
                    case 'alumno':
                        header('location: ../../Account/Usuarios/Alumno/');
                        break;
                }
            }
        }

        public function comprobarInactividad(){
            date_default_timezone_set('America/Mexico_City');

            $ultimoAcceso = $_SESSION['acceso'];
            $ahora = Date('Y-n-j h:i:s');
            $tiempo_transcurrido = (strtotime($ahora) - strtotime($ultimoAcceso));

            // Se compara el tiempo
            if($tiempo_transcurrido >= 3000){
                // se destruye la sesion
                session_destroy();
                header('Location: http://localhost/Proyecto/Account/Login/');
            }else{
                $_SESSION['acceso'] = $ahora;
            }
        }

    }

?>