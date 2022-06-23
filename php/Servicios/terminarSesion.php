<?php 
    require('../Sesion.php');
    $sesion = new Sesion();
    session_start();
    $sesion->terminarSesion();
?>