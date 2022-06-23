<?php

    class Trayectoria{

        private $creditosMinimosLargo = 25;
        private $creditosMinimosCorto = 4;
        private $creditosMaximosLargo = 50;
        private $creditosMaximosCorto = 16;
        private $creditosAcumulados;
        private $json;
        private $datos = [];

        public function __construt(){}

        public function getTrayectoria(){
            return $this->json;
        }

        public function guardarTrayectoria($conexion, $user, $json){
            $con = $conexion->conectarDB();
            $sql = "INSERT INTO trayectorias (trayectoria, trayectoria_json)
                            VALUES ('$user', '$json')";
            $resultado = $con->query($sql);

            if(!$resultado){
                return 0;
                exit;
            }
            return 1;
            exit;
        }

        public function actualizarTrayectoria($conexion, $user, $json){
            $con = $conexion->conectarDB();
            $sql = "UPDATE trayectorias SET trayectoria_json = '$json' WHERE trayectoria = '$user'";
            $resultado = $con->query($sql);

            if(!$resultado){
                return 0;
                exit;
            }
            return 1;
            exit;
        }

        public function consultarTrayectoria($conexion, $idTrayectoria){
            $con = $conexion->conectarDB();
            $sql = "SELECT * FROM trayectorias WHERE trayectoria = '$idTrayectoria'";
            $resultado = $con->query($sql);

            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();

                $obj = new stdClass();
                $obj->id = $row['id'];
                $obj->json = json_decode($row['trayectoria_json'], JSON_UNESCAPED_UNICODE);
                $obj->acumulados = $row['cAcumulados'];
                $this->creditosAcumulados = $row['cAcumulados'];
                $this->json = json_decode($row['trayectoria_json'], JSON_UNESCAPED_UNICODE);
                return $this->datos[0] = $obj;
                exit;
            }

            return 0;
        }

        public function validarCiclo($ciclo){
            $type = $ciclo->type;
            $creditos = (($type == 'largo') ? $this->creditosMaximosLargo : $this->creditosMaximosCorto) - $ciclo->creditos;
            $creditosValidar = ($type == 'largo') ? $this->creditosMinimosLargo : $this->creditosMinimosCorto;
    
            if(($creditos >= $creditosValidar) ? true : false){
                return 1;
                exit;
            }
            return 0;
            exit;
        }

        private function setCreditosAcumulados($conexion, $usuario, $creditos){
            $con = $conexion->conectarDB();
            $sql = "UPDATE trayectorias SET cAcumulados = cAcumulados  + $creditos WHERE trayectoria = '$usuario'";
            $resultado = $con->query($sql);
        }

        public function getCreditosAcumulados(){
            return $this->creditosAcumulados;
        }

        public function getCreditosRestantes($creditosCarrera){
            return $creditosCarrera - $this->getCreditosAcumulados();
        }

        public function getAvance($creditosTotales){
            return ($this->getCreditosAcumulados() / $creditosTotales) *  100;
        }

        public function getEstadoAsignatura($ciclo, $clave){
            foreach($this->json['ciclos'][$ciclo]['asignaturas'] as $asignatura){
                if($asignatura['clave'] == $clave){
                    return array($asignatura['status'], $asignatura['reprobadas'], $asignatura['nombre']);
                }
            }
        }
        
        public function setReprobada($ciclo, $clave){
            foreach($this->json['ciclos'][$ciclo]['asignaturas'] as &$asignatura){
                if($asignatura['clave'] == $clave){
                    $asignatura['reprobadas'] = intval($asignatura['reprobadas']) + 1;
                }
            }
        }

        public function setAprobada($conexion, $ciclo, $clave, $usuario){
            foreach($this->json['ciclos'][$ciclo]['asignaturas'] as &$asignatura){
                if($asignatura['clave'] == $clave){
                    $asignatura['status'] = 1;
                    $this->setCreditosAcumulados($conexion, $usuario, $asignatura['creditos']);
                }
            }
        }

        public function setAviso($aviso){
            array_push($this->json['avisos'], $aviso.'&'.date('F j, Y'));
        }

        public function addReprobada($nombre, $ciclo, $creditosTotales){
            $info = new stdClass();
            $info->ciclo = $ciclo;
            $info->nombre = $nombre;
            array_push($this->json['reprobadas'], $info);


            if(count($this->json['reprobadas']) == 10 && $this->getAvance($creditosTotales) < 50){
                $this->setAviso('A%0%0%3');
            }
        }

        public function getListaReprobadas(){
            return $this->json['reprobadas'];
        }

        public function marcarMensaje($conexion, $usuario, $rol, $index){
            //funcion explote divide una cadena string en un arreglo
            $opciones = explode('&', $this->json['avisos'][$index]);
            ($rol == 'docente') ? $opciones[1] = 1 : $opciones[2] = 1;
            if($opciones[1] && $opciones[2]){
                array_splice($this->json['avisos'], $index, 1);
            }else{
                //funcion implode une arreglo en un string
                $this->json['avisos'][$index] = implode('&', $opciones);
            }
            $this->actualizarTrayectoria($conexion, $usuario, json_encode($this->getTrayectoria(), JSON_UNESCAPED_UNICODE));
        }

        public function getCountMsm(){
            return count($this->json['avisos']);
        }
    
    }
?>