$(document).ready(function(){
    tablaParqueaderos = $("#tablaParqueaderos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formParqueaderos").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Parqueadero");            
    $("#modalCRUD").modal("show");        
    id_parqueadero=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id_parqueadero = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    direccion = fila.find('td:eq(2)').text();
    capacidad = parseInt(fila.find('td:eq(3)').text());
    
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#capacidad").val(capacidad);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Parqueadero");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id_parqueadero = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id_parqueadero+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_parqueadero:id_parqueadero},
            success: function(){
                tablaParqueaderos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formParqueaderos").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    direccion = $.trim($("#direccion").val());
    capacidad = $.trim($("#capacidad").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, direccion:direccion, capacidad:capacidad, id_parqueadero:id_parqueadero, opcion:opcion},
        success: function(data){  
            console.log(data);
            id_parqueadero = data[0].id_parqueadero;            
            nombre = data[0].nombre;
            direccion = data[0].direccion;
            capacidad = data[0].capacidad;
            if(opcion == 1){tablaParqueaderos.row.add([id_parqueadero,nombre,direccion,capacidad]).draw();}
            else{tablaParqueaderos.row(fila).data([id_parqueadero ,nombre,direccion,capacidad]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});