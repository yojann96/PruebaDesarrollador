function docObligatorio() {
    alert("Clic en boton guardar..");
}

$(".Crear_Habitacion").on("click", function() {
    $.ajax({
        headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
        url: '../crearHabitacionHotel',
        type: "GET",
        data: {
            NroHabsDisponibles: $("#nroHabsDisponibles").val(),
            IdHotel: $("#IdHotel").val()
        },
        dataType: "JSON",
        cache: false,
        beforeSend: function() {

        },
        success: function(data) {

        },
        error: function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
        /*complete: function(xhr, status) {
            alert('Petición realizada');
            //$("#idCiudadEmpleado").html(optionsRta);
        },*/
        async: false
    });
});