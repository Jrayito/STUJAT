<?php 

    class Tutorado extends Usuarios{
        
        private $matricula;
        private $academica;
        private $tutor;
        private $carrera;
        private $datos = [];

        public function __construct(){}

        public function miInformacion($conexion, $usuario){
            $con  = $conexion->conectarDB();
            $sql = "SELECT a.*, d.nombre as academica
                    FROM alumnos as a, divisiones as d
                    WHERE usuario = '$usuario' AND a.dAcademica = d.id";
            $resultado = $con->query($sql);

            $rows = $resultado->fetch_assoc();
            $this->matricula = $rows['usuario'];
            $this->tutor = $rows['docente'];
            $this->academica = $rows['academica'];
            $this->carrera = $rows['carrera'];
            $this->setDatos($rows['nombre'], $rows['apellidos'], $rows['contrasena'], $rows['correo']);
        }

        public function getMatricula(){
            return $this->matricula;
        }

        public function getDivisionAcademica(){
            return 'Division Académica '.$this->academica;
        }

        public function getCarrera(){
            return $this->carrera;
        }
        
        public function getTutor(){
            return $this->tutor;
        }
    }
?>