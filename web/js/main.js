function filterPerson() {
    $.ajax({
        url: "listadoService.php",
        type: 'GET',
        data: {
            busqueda: $("#busqueda").val(),
            items: $("#cantItems option:selected").val(),
            orden: $("#orden").val(),
        },
        success: function (data) {
            var JSONArray = $.parseJSON(data);
            var HTML = "";
            $.each(JSONArray.result, function (i, item) {
                console.log(item);
                HTML += "<tr><td>" + item['id'] + "</td><td>" + item['nombre'] + "</td><td>" + item['apellido'] + "</td><td>" + item['edad'] + "</td><td>" +item['fecha_nacimiento'] +"</td><td>" + item['dni']+"</td></tr>"
            });
            $(".jumbotron").show();
            $(".body-table").html(HTML);
            

        }});
}
;


