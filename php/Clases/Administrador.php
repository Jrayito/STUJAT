<?php

    class Administrador extends Usuarios{

        private $cademica;
        private $noEmpleado;
        private $datos = [];

        public function __construct(){}

        public function guardarTutor($conexion, $usuario, $password, $nombre, $apellidos, $correo, $division, $rol){
            $con = $conexion->conectarDB();
            $sql = "INSERT INTO docentes () 
                    VALUES ('$usuario', '$password', '$nombre', '$apellidos', '$correo', '$division', '$rol')";
            $resultado = $con->query($sql);
            if(!$resultado){
                return 'error';
            }

            return 1;
        }

        public function guardarTutorado($conexion, $usuario, $password, $nombre, $apellidos, $correo, $carrera, $tutor, $rol, $division){
            $con = $conexion->conectarDB();
            $sql = "INSERT INTO alumnos () 
                    VALUES ('$usuario', '$password', '$nombre', '$apellidos', '$correo', '$carrera', '$tutor', '$rol', '$division')";
            $resultado = $con->query($sql);
            if(!$resultado){
                return 'error';
            }
            return 1;
        }

        public function buscarUsuario($conexion, $nombre, $tabla){
            $con = $conexion->conectarDB();
            $sql = "SELECT a.usuario, a.nombre, a.apellidos, a.correo, d.nombre as academica
                    FROM $tabla as a, divisiones as d 
                    WHERE  (a.nombre LIKE '%$nombre%' OR a.apellidos LIKE '%$nombre%' OR a.usuario = '$nombre')
                    AND a.dAcademica = d.id";
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $i = 0;
                while($row = $resultado->fetch_assoc()){
                    $obj = new stdClass();
                    $obj->usuario = $row['usuario'];
                    $obj->nombre = $row['nombre'];
                    $obj->apellidos = $row['apellidos'];
                    $obj->correo = $row['correo'];
                    $obj->acedemica = $row['academica'];
                    $this->datos[$i] = $obj;
                    $i++;
                }
                return $this->datos;
                exit;
            }

            return $this->datos;
        }

        public function setInformacion($nombre, $apellidos, $contrasena, $correo, $academica, $noEmpleado){
            $this->academica = $academica;
            $this->noEmpleado = $noEmpleado;
            $this->setDatos($nombre, $apellidos, $contrasena, $correo);
        }
    } 

?>