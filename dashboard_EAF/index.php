<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Parqueaderos!</h1>
    
    
<?php
include_once 'bd/conexion.php';
$objeto=new CConexion();
$conexion= $objeto->ConexionBD();

$consulta ="SELECT id_parqueadero,nombre,direccion,capacidad FROM  parqueadero_eaf.parqueadero";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
  
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Parqueadero</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaParqueaderos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id_Parqueadero</th>
                                <th>Nombre</th>
                                <th>Dirección</th>                                
                                <th>Capacidad</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id_parqueadero'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['direccion'] ?></td>
                                <td><?php echo $dat['capacidad'] ?></td>    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formParqueaderos">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="direccion" class="col-form-label">Direción:</label>
                <input type="text" class="form-control" id="direccion">
                </div>                
                <div class="form-group">
                <label for="capacidad" class="col-form-label">Capacidad:</label>
                <input type="number" class="form-control" id="capacidad">
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
   
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>