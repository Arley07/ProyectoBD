<?php
session_start();
include_once 'conexion.php';
$objeto=new CConexion();
$conexion= $objeto->ConexionBD();

// Recepción de los datos enviados mediante POST desde el JS   
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password);

$consulta = "SELECT * FROM parqueadero_eaf.usuario  WHERE nombre='$usuario' AND contraseÑa='$pass' ";	
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 


if($resultado->rowCount() >= 1){ 
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
    $_SESSION["s_usuario"] = $usuario;    
    $_SESSION["s_password"] = $password;

}else{
    $_SESSION["s_usuario"] = null;  
    $_SESSION["s_password"] = null; 
    $data=null;
}

print json_encode($data);//envio el array final el formato json a AJAX
$conexion=null;