<?php

    class Conexion{
        //variables de acceso a la base de datos 
        private $servidor = 'localhost';
        private $usuario = 'root';
        private $password = '';
        private $db = 'trayectorias';

        public function __construct(){}

        public function conectarDB(){
            //se crea la conexion
            $con = new mysqli($this->servidor, $this->usuario, $this->password, $this->db);

            // en caso de error
            if($con->connect_error){
                die('Conexion fallida: '.$con->connect_error);
            }
            // se retorna la conexion
            return $con;
        }
    }

?>