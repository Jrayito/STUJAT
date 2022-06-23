<?php
    class Asignatura{

        private $nombre;
        private $clave;
        private $horasTeoricas;
        private $horasPracticas;
        private $creditos;
        private $tipo;
        private $areaFormacion;
        private $areaConocimiento;
        private $antecedente;
        private $optativa;
        private $carrera;
        private $src;
        private $ciclo;
        private $datos = [];

        public function __construct(){}

        public function setInformacion($nombre, $clave, $teoricas, $practicas, $creditos, $tipo, $areaFormacion,$areaConocimiento, $antecedente,
                            $optativa, $carrera, $src, $ciclo){
            $this->nombre = $nombre;
            $this->clave = $clave;
            $this->horasTeoricas = $teoricas;
            $this->horasPracticas = $practicas;
            $this->creditos = $creditos;
            $this->tipo = $tipo;
            $this->areaFormacion = $areaFormacion;
            $this->areaConocimiento = $areaConocimiento;
            $this->antecedente = $antecedente;
            $this->optativa = $optativa;
            $this->carrera = $carrera;
            $this->src = $src;
            $this->ciclo = $ciclo;
        }

        // Pasar sql para que sirva en otra funcionalidad
        public function buscarAsignatura($conexion, $sql){
            $con = $conexion->conectarDB();
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $i = 0;
                
                while($row = $resultado->fetch_assoc()){
                    $obj = new stdClass();
                    $obj->clave = $row['clave'];
                    $obj->nombre = $row['nombre'];
                    $obj->teoricas = $row['horasT'];
                    $obj->practicas = $row['horasP'];
                    $obj->creditos = $row['creditos'];
                    $obj->tipo = $row['tipo'];
                    $obj->optativa = $row['optativa'];
                    $obj->areaFormacion = $row['areaFormacion'];
                    $obj->areaConocimiento = $row['areaConocimiento'];
                    $obj->pdf = $row['urlPDF'];
                    $obj->acro = $row['carrera'];
                    $obj->antecedente = $row['antecedente'];
                    if(isset( $row['carreraFull'])) {
                        $obj->carrera = $row['carreraFull'];
                    }
                    $obj->ciclo = $row['ciclo'];
                    $this->datos[$i] = $obj;
                    $i++;
                }
                return $this->datos;
                exit;
            }
            return $this->datos;
        }

        public function consultarSubsecuente($conexion, $clave){
            $con = $conexion->conectarDB();
            $sql = "SELECT * FROM asignaturas WHERE antecedente = '$clave'";
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                // return $resultado->fetch_assoc(); 
                $row = $resultado->fetch_assoc();
                if(isset($row['clave'])){
                    $obj2 = new stdClass();
                    $obj2->nombre = $row['nombre'];
                    $obj2->clave = $row['clave'];
                    return $obj2;
                    exit;
                }             
            }

            return $resultado;
        }
        public function consultarAntecedente($conexion, $clave){
            $con = $conexion->conectarDB();
            $sql = "SELECT * FROM asignaturas WHERE clave = '$clave'";
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                if(isset($row['clave'])){
                    $obj2 = new stdClass();
                    $obj2->nombre = $row['nombre'];
                    $obj2->clave = $row['clave'];
                    return $obj2;
                    exit;
                }    
            }

            return $resultado;
        }
        
        public function guardarAsignatura($conexion){
            $sql = "SELECT * FROM asignaturas WHERE clave = '{$this->clave}'";
            $validacion = $this->buscarAsignatura($conexion, $sql);

            // Validacion que la asignatura no este registrada
            if(!$validacion){
                $con = $conexion->conectarDB();
                $sql1 = "INSERT INTO asignaturas ()
                        VALUES ('{$this->clave}', '{$this->nombre}', {$this->horasTeoricas}, {$this->horasPracticas},
                        {$this->creditos}, '{$this->tipo}', {$this->optativa}, {$this->areaFormacion}, {$this->areaConocimiento},'{$this->antecedente}',
                        '{$this->src}', '{$this->carrera}', {$this->ciclo})";
            
                $resultado = $con->query($sql1);

                // Si la insercion no se pudo realizar
                if(!$resultado){
                    return "error";
                }
                return 1;
            }
            // Se retorna cero cuando se valida que la asignatura existe
            return 0;
            
        }
        public function actualizarAsignatura($conexion, $clave, $nombre){
            $con = $conexion->conectarDB();
            $sql = "UPDATE asignaturas 
                    SET clave = $clave, nombre = $nombre 
                    WHERE clave = $clave";
            $resultado = $con->query($sql);

            if(!$resultado){
                return 'error';
                exit;
            }

            return 1;
        }

        public function consultarAsignaturas($conexion, $sql){
            $con = $conexion->conectarDB();
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $i = 0;
                while($row = $resultado->fetch_assoc()){
                    $obj = new stdClass();
                    $obj->clave = $row['clave'];
                    $obj->nombre = $row['nombre'];
                    $obj->areaConocimiento = $row['areaConocimiento'];
                    // $obj->antecedente = $row['antecedente'];
                    $obj->creditos = $row['creditos'];
                    $obj->tipo = $row['tipo'];
                    $obj->ciclo = $row['ciclo'];
            
                    $clave = $row['clave'];
                    if($row['antecedente']){
                        $obj->antecedente = $this->consultarAntecedente($conexion, $row['antecedente']);
                    }else{
                        $obj2 = new stdClass();
                        $obj2->clave = '';
                        $obj->antecedente = $obj2;
                    }

                    $subsecuente = $this->consultarSubsecuente($conexion, $clave);
            
                    if(isset($subsecuente->clave)){
                        $obj->subsecuente = $subsecuente;
                    }
                    $this->datos[$i] = $obj;
                    $i++;
                }
                return $this->datos; exit;
            }
            return $this->datos;
        }   
        public function eliminarAsignatura(){}
        public function listarAsignaturas(){}
    }
?>