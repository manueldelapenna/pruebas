function listPermisos(){
    $.ajax({
        url: "api/permisosApi.php",
        type: 'GET',
        data: {
            busqueda: $("#busqueda").val(),
            items: $("#cantItems option:selected").val(),
            orden: $("#ordenActual").val(),
            pagina: $("#paginaActual").val(),
            direccion : $("#direccionActual").val()
        },
        success: function (data) {
            
            var HTML = "";
            $.each(data.permisos, function (i, item) {
                HTML += '<tr><td>'+item['id']+'</td><td><input type="text" id="'+item['id']+'" name="permiso" value="'+item['name']+'" disabled>';
                HTML += '<input type="submit" name="confirmar" value="confirmar" class="btn btn-success" onclick="modificarPermiso('+item['id']+')"></td>';
                HTML += '<td><input type="submit" name="modificar" value="Modificar" class="btn btn-primary" onclick="activarModiPermiso('+item['id']+')">';
                HTML += '<td><input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger" onclick="eliminarPermiso('+item['id']+')">';
                HTML += '</td></tr>';
            });
            
            $("#body-permisos").html(HTML);

            //dibujar paginador
            var cantPaginas = data.paginas;
            var paginador = "";
            var paginaActual = $("#paginaActual").val();
            for (var i = 1; i <= cantPaginas; i++) {
                if (paginaActual == i) {
                    var active = "active";
                } else {
                    active = "";
                }
                paginador += "<li class=" + active + "><a>" + i + "</a></li>";

            }
            $(".pagination").html(paginador);
        }
        
        
    });
};


$(document).ready(function () {
    $(".pagination").on( "click", "a", function () {
        $("#paginaActual").val($(this).text());
        listPermisos();
    });
    
    $(".head-table").on( "click", "a", function () {
        //var iconoDireccion = $("#iconoDireccion").val();
       
        //cambio de direccion
        if($("#direccionActual").val() === "ASC"){
            $("#direccionActual").val("DESC");
            $(this+' span').removeClass('glyphicon glyphicon-circle-arrow-up');
            $(this+'[name= '+$(this).attr('name')+'] span').addClass('glyphicon glyphicon-circle-arrow-down');
        }else{
            $("#direccionActual").val("ASC");
            $(this+' span').removeClass('glyphicon glyphicon-circle-arrow-down');
            $(this+'[name= '+$(this).attr('name')+'] span').addClass('glyphicon glyphicon-circle-arrow-up');
        }
        
       // $(".table").find("span").remove();
        //$(this).append("span").addClass(iconoDireccion);
        
        //cambio el orden
        $("#ordenActual").val($(this).attr('name'));
        listPermisos();
    });
    
    });
    
function eliminarPermiso(id){
    $.ajax({
        url: "api/eliminarPermiso.php",
        type: 'POST',
        data: {
            id: id
        },
        success: function (data) {
          
        alert(data.message);
        if(data.code == 200){
            listPermisos();
        }
        }
        
        
    });
}


function activarModiPermiso(id){
   $('#'+id).prop('disabled', false); 
    
}