var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { $("#add-hotel").submit(); }
    });

    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#add-hotel").validate({
            rules: {
                hotel: "required",
                url_foto: "required",
                descripcion: "required",
                prefijo: "required",
                iva: "required",
                ish: "required",
                markup: "required",
                comision: "required",
            },
            messages: {
                hotel: "Como se llama el hotel?",
                url_foto: "Ingresa una url para la foto",
                descripcion: "Ingresa una descripcion de hotel, aparecera el la pagina de hoteles",
                prefijo: "Un nombre corto para el hotel",
                iva: "Ejemplo 16",
                ish: "Ejemplo 3",
                markup: "Ejemplo 10",
                comision: "Ejemplo 4",
            }
        });
    });

    $.validator.setDefaults({
        submitHandler: function() { $("#add-plan").submit(); }
    });

    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#add-plan").validate({
            rules: {
                plan: "required",
                prefijo: "required",
            },
            messages: {
                plan: "Como se llama el plan?",
                prefijo: "Un nombre corto para el plan",
            }
        });
    });

    $.validator.setDefaults({
        submitHandler: function() { $("#add-ocupacion").submit(); }
    });

    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#add-ocupacion").validate({
            rules: {
                ocupacion: "required",
                adultos: "required",
                menores: "required",
                prefijo: "required",
            },
            messages: {
                ocupacion: "Que ocupacion es?",
                adultos: "Cuantos adultos se pueden hospedar?",
                menores: "Cuantos menores se pueden hospedar?",
                prefijo: "Un nombre corto para la ocupacion",
            }
        });
    });
        $.validator.setDefaults({
        submitHandler: function() { $("#add-tipohabitacion").submit(); }
    });

    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#add-tipohabitacion").validate({
            rules: {
                tipohabitacion: "required",
                prefijo: "required",
            },
            messages: {
                tipohabitacion: "Que tipo de habitacion es?",
                prefijo: "Un nombre corto para el tipo e habitacion",
            }
        });
    });
    
    $.validator.setDefaults({
        submitHandler: function() { $("#add-habitacion").submit(); }
    });

    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#add-habitacion").validate({
            rules: {
                hotel: "required",
                plan: "required",
                tipohabitacion: "required",
                ocupacion: "required",
                cantidad: "required",
            },
            messages: {
                hotel: "Elije un hotel",
                plan: "Que plan necesitas?",
                tipohabitacion: "Que tipo de habitacion es?",
                ocupacion: "Elije un tipo de ocupacion para la habitación",
                cantidad: "Cuantas habitaciones necesitas?",
            }
        });
    });


};