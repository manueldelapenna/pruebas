function filterPerson() {

    $.ajax({
        url: "api/listadoService.php",
        type: 'GET',
        data: {
            busqueda: $("#busqueda").val(),
            items: $("#cantItems option:selected").val(),
            orden: $("#ordenActual").val(),
            pagina: $("#paginaActual").val(),
            direccion: $("#direccionActual").val()
        },
        success: function (data) {

            var HTML = "";
            $.each(data.result, function (i, item) {
                
                HTML += '<tr><td>' + item['id'] + '</td>';
                HTML += '<td><div class="input-group"><input type="text" class="form-control" id="' + item['id'] + '" name="persona" value="' + item['nombre'] + '" disabled><span class="input-group-btn" id="editbutton-' + item['id'] + '" style="display:none"> <button class="btn btn-success" type="button" onclick="cambiarPersona(' + item['id'] + ')">Aceptar</button><button class="btn btn-warning" type="button" onclick="cancelarEdicion(' + item['id'] + ',\'' + item['nombre'] + '\')">Cancelar</button> </span> </div></td>';
                HTML += '<td>' + item['apellido'] + ' </td>';
                HTML += '<td>' + item['edad'] + '</td>';
                HTML += '<td>' + parseDate(item['fecha_nacimiento'])+'</td>';
                HTML += '<td>' + item['dni'] + '</td>';
                HTML += '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick=verPersona(' + item['id'] + ')>Ver</button>';
                HTML += '<td><input type="submit" name="modificar" value="Modificar" class="btn btn-primary" onclick="activarModiPersona(' + item['id'] + ')">';
                HTML += '<td><input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger" onclick="eliminarPersona(' + item['id'] + ')">';
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
    $(".pagination").on("click", "a", function () {
        $("#paginaActual").val($(this).text());
        filterPerson();
    });

    $(".head-table").on("click", "a", function () {
        //var iconoDireccion = $("#iconoDireccion").val();

        //cambio de direccion
        if ($("#direccionActual").val() === "ASC") {
            $("#direccionActual").val("DESC");
            $(this + ' span').removeClass('glyphicon glyphicon-circle-arrow-up');
            $(this + '[name= ' + $(this).attr('name') + '] span').addClass('glyphicon glyphicon-circle-arrow-down');
        } else {
            $("#direccionActual").val("ASC");
            $(this + ' span').removeClass('glyphicon glyphicon-circle-arrow-down');
            $(this + '[name= ' + $(this).attr('name') + '] span').addClass('glyphicon glyphicon-circle-arrow-up');
        }

        // $(".table").find("span").remove();
        //$(this).append("span").addClass(iconoDireccion);

        //cambio el orden
        $("#ordenActual").val($(this).attr('name'));
        filterPerson();
    });

    $("#volver").click(function () {
        window.history.back();
    })
});


function eliminarPersona(id) {
    $.ajax({
        url: "api/eliminarPersona.php",
        type: 'POST',
        data: {
            id: id
        },
        success: function (data) {

            alert(data.message);
            if (data.code == 200) {
                filterPerson();
            }
        }


    });
}

function activarModiPersona(id) {
    $('#' + id).prop('disabled', false);
    $('#editbutton-' + id).show();

}

function cancelarEdicion(id, name) {
    $('#' + id).val(name);
    $('#editbutton-' + id).hide();
    $('#' + id).prop('disabled', true);

}

function cambiarPersona(id) {

    var nombre = $('#' + id).val();

    $.ajax({
        url: "api/editarPersona.php",
        type: 'POST',
        data: {
            nombre: nombre,
            id: id
        },
        success: function (data) {

            alert(data.message);
            if (data.code == 200) {
                filterPerson();

            }
        }


    });
}



function verPersona(id) {

    $.ajax({
        url: "../web/api/verPersona.php",
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            var info = data.results;
            console.log(data.results);
            if (data.code == 200) {
                var HTML = '';
                HTML += '<label>ID: </label>' + info.id + '<br/>';
                HTML += '<label>Nombre: </label>' + info.nombre + '<br/>';
                HTML += '<label>Apellido: </label>' + info.apellido + '<br/>';
                HTML += '<label>Edad: </label>' + info.edad + '<br/>';
                HTML += '<label>DNI: </label>' + info.dni + '<br/>';
                HTML += '<label>Fecha de Nacimiento: </label>' + parseDate(info.fecha_nacimiento) + '<br/>';
            }

            $('.modal-body').html(HTML);


        }


    });

}
;


function parseDate(yearMonthDayFormatDate){
    var CutFecha = yearMonthDayFormatDate.split("-");
    return CutFecha[2] + '-' + CutFecha[1] + '-' + CutFecha[0];
}