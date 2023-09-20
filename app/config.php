<?php
$URL="http://localhost/horus2";
$URL_LOGIN="http://localhost/horus2/login/inicio.php";
 define('servidor', 'localhost');
 define('nombre_bd', 'horus');
 define('usuario', 'root');
 define('password', '');	
 $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
 try{
     $conn = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
     
          return $conn;
 }catch (Exception $e){
     die("El error de Conexión es: ". $e->getMessage());
 }


