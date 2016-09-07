function buscarAjax() {
    $.ajax({
        url: "listadoService.php",
        success: function (data) {
            var JSONArray = $.parseJSON(data);
            var HTML = "";
             $.each(JSONArray.result, function (i, item ) {
                 console.log(item);
                HTML += "<tr><td>"+item['id']+"</td><td>"+item['nombre']+"</td><td>"+item['apellido']+"</td><td>"+item['edad']+"</td></tr>"
            });
            $(".jumbotron").show();
            $(".body-table").html(HTML);
            
        }});
}

$("#busqueda").keyup(function(){
    alert("entra");
   filterPerson(); 
});
function filterPerson() {
    $.ajax({
        url: "listadoService.php",
        type: 'GET',
        data: {
            busqueda: $("#busqueda").val()
        },
        success: function (data) {
            var JSONArray = $.parseJSON(data);
            var HTML = "";
             $.each(JSONArray.result, function (i, item ) {
                 console.log(item);
                HTML += "<tr><td>"+item['id']+"</td><td>"+item['nombre']+"</td><td>"+item['apellido']+"</td><td>"+item['edad']+"</td></tr>"
            });
            $(".jumbotron").show();
            $(".body-table").html(HTML);
            
        }});
};


