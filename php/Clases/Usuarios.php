<?php

    class Usuarios{

        private $nombre;
        private $apellidos;
        private $contrasena;
        private $correo;

        public function __construct(){}

        public function iniciarSesion(){
            echo "Se hace la validacion en el cliente";
        }

        public function validarUsuario($conexion, $tabla, $usuario, $contrasena){
            $con = $conexion->conectarDB();
            $sql = "SELECT usuario, rol FROM $tabla WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
            $resultado =  $con->query($sql);

            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                return $row;
            }

            return 0;
        }
        
        public function setDatos($nombre, $apellidos, $contrasena, $correo){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->contrasena = $contrasena;
            $this->correo = $correo;
        }
        
        public function getNombre(){
            return $this->nombre;
        }

        public function getApellidos(){
            return $this->apellidos;
        }

        public function getFullName(){
            return $this->nombre.' '.$this->apellidos;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function getContrasena(){
            return $this->contrasena;
        }
    }
?>