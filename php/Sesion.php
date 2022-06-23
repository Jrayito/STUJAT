<?php

    class Sesion{

        public function __construct(){
            
        }

        public function guardarSesion($usuario, $rol){
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $rol;
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

    }

?>