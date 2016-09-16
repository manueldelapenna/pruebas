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
            var JSONArray = $.parseJSON(data);
            console.log(data);
            var HTML = "";
            console.log(JSONArray);
            $.each(JSONArray.permisos, function (i, item) {
                HTML += '<tr><td>'+item['id']+'</td><td>'+item['name']+'</td>';
                HTML += '<td>form action="../functions/eliminarPermiso.php" method ="POST">';
                HTML += '<input type="hidden" value="'+item['id']+'" name="id" >';
                HTML += '<input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger">';
                HTML += '</form></td>';
            });
            
            $("#body-permisos").html(HTML);

            //dibujar paginador
            var cantPaginas = JSONArray.paginas;
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
    
