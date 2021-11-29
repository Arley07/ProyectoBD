<?php
include_once 'conexion.php';
$objeto=new CConexion();
$conexion= $objeto->ConexionBD();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$capacidad = (isset($_POST['capacidad'])) ? $_POST['capacidad'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_parqueadero = (isset($_POST['id_parqueadero'])) ? $_POST['id_parqueadero'] : '';




switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO parqueadero_eaf.parqueadero (nombre, direccion, capacidad) VALUES ('$nombre', '$direccion', '$capacidad') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
    
        $consulta = "SELECT id_parqueadero,nombre, direccion, capacidad FROM parqueadero_eaf.parqueadero  ORDER BY id_parqueadero DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE parqueadero_eaf.parqueadero SET nombre='$nombre', direccion='$direccion', capacidad='$capacidad' WHERE id_parqueadero='$id_parqueadero' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_parqueadero, nombre, direccion, capacidad FROM parqueadero_eaf.parqueadero WHERE id_parqueadro='$id_parqueadero' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        echo $opcion;
        $consulta = "DELETE FROM parqueadero_eaf.parqueadero WHERE id_parqueadero='$id_parqueadero' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

?>