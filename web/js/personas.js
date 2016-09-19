function filterPerson() {

    $.ajax({
        url: "api/listadoService.php",
        type: 'GET',
        data: {
            busqueda: $("#busqueda").val(),
            items: $("#cantItems option:selected").val(),
            orden: $("#ordenActual").val(),
            pagina: $("#paginaActual").val(),
            direccion : $("#direccionActual").val()
        },
        success: function (data) {
            console.log(data.result);
            var HTML = "";
            $.each(data.result, function (i, item) {
                var CutFecha = item['fecha_nacimiento'].split("-");
                HTML += '<tr><td>' + item['id'] + '</td><td><input type="text" name="nombre" value=" '+ item['nombre'] + '" disabled></td><td>' + item['apellido'] +' </td><td>' + item['edad'] + '</td><td>' + CutFecha[2]+'-'+CutFecha[1]+'-'+CutFecha[0] + '</td><td>' + item['dni'] + '</td>';
                HTML += '<td><a href="formVerPersona.php?id='+item['id']+'" class="btn btn-success">Ver</a></td>';
                HTML += '<td><a href="formModificarPersona.php?id='+item['id']+'" class="btn btn-primary">Modificar</a></td>';
               HTML += '<td><input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger" onclick="eliminarPersona('+item['id']+')">';
                HTML += '</td></tr>';
            });
            $(".jumbotron").show();
            $(".body-table").html(HTML);

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

        }});
}
;


$(document).ready(function () {
    $(".pagination").on( "click", "a", function () {
        $("#paginaActual").val($(this).text());
        filterPerson();
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
        filterPerson();
    });
    
    $("#volver").click(function(){
        window.history.back();
    })
});


function eliminarPersona(id){
    $.ajax({
        url: "api/eliminarPersona.php",
        type: 'POST',
        data: {
            id: id
        },
        success: function (data) {
          
        alert(data.message);
        if(data.code == 200){
           filterPerson();
        }
        }
        
        
    });
}
