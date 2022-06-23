<?php

    class Carrera{

        private $nombre;
        private $acronimo;
        private $creditos;
        private $division;
        private $areaConocimiento;
        private $datos = [];

        public function __construct(){}

        public function guardarCarrera($conexion, $acronimo, $nombre, $creditos, $division, $json){
            $con = $conexion->conectarDB();
            $sql = "INSERT INTO carreras ()
                    VALUES ('$acronimo', '$nombre', $creditos, '$division', '$json')";
            $resultado = $con->query($sql);

            if(!$resultado){
                return 'error';
            }

            return 1;
        }


        //Busca todas las coincidencias
        public function buscarCarrera($conexion, $identificador){
            $con = $conexion->conectarDB();
            $sql = "SELECT c.*, d.nombre as academica 
                    FROM carreras as c, divisiones as d
                    WHERE (c.nombre LIKE '%$identificador%' OR c.dAcademica = '$identificador')
                    AND c.dAcademica = d.id";
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $i = 0;
                while($row = $resultado->fetch_assoc()){
                    $obj = new stdClass();
                    $obj->id = $row['id'];
                    $obj->nombre = $row['nombre'];
                    $obj->creditos = $row['creditos'];
                    $obj->academica = $row['academica'];
                    $obj->json = json_decode($row['areaConocimiento'], JSON_UNESCAPED_UNICODE);
                    $this->datos[$i] = $obj;
                    $i++;
                }
                return $this->datos;
                exit;
            }

            return $this->datos;
        }

        public function consultarCarrera($conexion, $identificador){
            $con = $conexion->conectarDB();
            $sql = "SELECT c.*, d.nombre as academica 
                    FROM carreras as c, divisiones as d 
                    WHERE c.id = '$identificador' AND c.dAcademica = d.id";
            
            $resultado = $con->query($sql);
            $rows = $resultado->fetch_assoc();
            $this->nombre = $rows['nombre'];
            $this->acronimo = $rows['id'];
            $this->creditos = $rows['creditos'];
            $this->division = $rows['academica'];
            $this->areaConocimiento = json_decode($rows['areaConocimiento'], JSON_UNESCAPED_UNICODE);
        }
        
        public function getnombreCarrera(){
            return $this->nombre;
        }

        public function getCreditosTotales(){
            return $this->creditos;
        }
        public function getAreaConocimiento(){
            return $this->areaConocimiento;
        }

        public function getDivisionAcademica(){
            return $this->division;
        }
    }
?>