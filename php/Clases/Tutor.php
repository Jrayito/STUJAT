<?php

    class Tutor extends Usuarios{
        
        private $academica;
        private $noEmpleado;
        private $misTutorados = [];

        public function __construct(){}

        public function getNoEmpleado(){
            return $this->noEmpleado;
        }

        public function getDivision(){
            return 'Division Academica '.$this->academica;
        }

        public function consultarTutorados($conexion){
            $con = $conexion->conectarDB();
            $sql = "SELECT usuario, nombre, apellidos, correo FROM alumnos WHERE docente = {$this->getNoEmpleado()}";
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $i = 0;
                while($row = $resultado->fetch_assoc()){
                    $obj = new stdClass();
                    $obj->matricula = $row['usuario'];
                    $obj->nombre = $row['nombre'];
                    $obj->apellidos = $row['apellidos'];
                    $obj->correo = $row['correo'];
                    $this->misTutorados[$i] = $obj;
                    $i++;

                }
                return $this->misTutorados;
            }
            return $this->misTutorados;
        }

        public function setInformacion($nombre, $apellidos, $contrasena, $correo, $academica, $noEmpleado){
            $this->academica = $academica;
            $this->noEmpleado = $noEmpleado;
            $this->setDatos($nombre, $apellidos, $contrasena, $correo);
        }

        public function getTutor($conexion, $noEmpleado){
            $con = $conexion->conectarDB();
            $sql = "SELECT t.*, d.nombre as academica FROM docentes as t, divisiones as d WHERE usuario = '$noEmpleado' AND t.dAcademica = d.id";
            $resultado = $con->query($sql);
            $rows = $resultado->fetch_assoc();

            $this->setInformacion($rows['nombre'], $rows['apellidos'], $rows['contrasena'], $rows['correo'], $rows['academica'], $rows['usuario']);
        } 

    }

?>