<?php
class  CConexion{
    public static function ConexionBD(){
        define('servidor', 'localhost');
        define('nombre_bd', 'postgres');
        define('usuario', 'postgres');
        define('password', 'Meliodas..07');
        /*$host ="localhost";
        $dbname = "postgres";
        $nombre = "postgres";
        $pasword ="Meliodas..07";*/

        $opciones= array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try{
            $conexion= new PDO("pgsql:host=".servidor."; dbname=".nombre_bd, usuario , password, $opciones );
            return $conexion;
        }
        catch(PDOException $e){
           die("El error de conexión es: ". $e->getMessage()); 
        }

        

    }

}
?>