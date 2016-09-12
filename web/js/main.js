function filterPerson() {

    $.ajax({
        url: "listadoService.php",
        type: 'GET',
        data: {
            busqueda: $("#busqueda").val(),
            items: $("#cantItems option:selected").val(),
            orden: $("#orden").val(),
            pagina: $("#paginaActual").val()
        },
        success: function (data) {
            var JSONArray = $.parseJSON(data);
            var HTML = "";
            $.each(JSONArray.result, function (i, item) {
                console.log(item);
                HTML += "<tr><td>" + item['id'] + "</td><td>" + item['nombre'] + "</td><td>" + item['apellido'] + "</td><td>" + item['edad'] + "</td><td>" + item['fecha_nacimiento'] + "</td><td>" + item['dni'] + "</td></tr>"
            });
            $(".jumbotron").show();
            $(".body-table").html(HTML);

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

        }});
}
;

$(document).ready(function () {
    $(".pagination").on( "click", "a", function () {
        $("#paginaActual").val($(this).text());
        filterPerson();
    });
});
