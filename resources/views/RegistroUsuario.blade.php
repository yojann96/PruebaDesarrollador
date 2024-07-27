<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/jquery.min.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    
    <br>
    <div align="center">
        <div class="figure">
            <img src="{{ asset('imagenes/logoAmazon.jpg') }}" width="100" height="50" />
        </div>
        <div class="col-md-6 border">
            <div class="container text-left">
                <div >
                    <h2>Crear tu cuenta</h2>
                </div>
                <br>
                <form class="form-group" id="formCrearUsuario" onsubmit="CrearUsuario(event)">
                    <div class="form-group">
                        <label class="form-label" for="label"><strong>Tu nombre</strong></label>
                        <input type="text" class="form-control" placeholder="Digite nombre" id="NombreUsuario" name="NombreUsuario" required value="">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="label"><strong>Correo electrónico</strong></label>
                        <input type="email" class="form-control" id="email" placeholder="Digitar correo"  name="email" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="label"><strong>Contraseña</strong></label>
                        <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Escribe la contraseña" min="6">
                        <p>La contraseña debe tener mínimo 6 caracteres</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="label"><strong>Vuelve a escribir la contraseña</strong></label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Vuelva a escribir la contraseña" autofocus="autofocus" min="6">
                    </div>
                    <button type="submit" class="btn btn-warning">Crear tu cuenta de amazon</button>
                    <p>Al crear una cuenta, aceptas las condiciones de uso y el avíso de privacidad</p>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    
    $(document).ready(function(){
        //alert("Cargó página OK?");
    });

    //  VARIABLES PARA CONTROLAR CONTRASEÑAS
    var pass1 = $('[name=pass1]');
	var pass2 = $('[name=pass2]');
	var confirmacion = "Las contraseñas si coinciden";
	var longitud = "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
	var negacion = "No coinciden las contraseñas";
	var vacio = "La contraseña no puede estar vacía";
	//oculto por defecto el elemento span
	var span = $('<span></span>').insertAfter(pass2);
	span.hide();


    //función que comprueba las dos contraseñas    
	function coincidePassword(){
		var valor1 = pass1.val();
		var valor2 = pass2.val();
		//muestro el span
		span.show().removeClass();
		//condiciones dentro de la función
		if(valor1 != valor2){
			span.text(negacion).addClass('negacion');
		}
		if( valor1.length == 0 || valor1 == "" ){
			span.text(vacio).addClass('negacion');
		}
		if( valor1.length < 6 ){
			span.text(longitud).addClass('negacion');
		}
		if( valor1.length != 0 && valor1 == valor2 ){
			span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
		}
	}
	
	//ejecuto la función al soltar la tecla para validar contraseñas
	pass2.keyup(function(){
		coincidePassword();
	});

    function CrearUsuario(event){
        event.preventDefault();
        var flagPassword = false;

        if( pass1.val().length < 6 ){
            alert("No cumple con el mínimo de caracteres (6).");
            flagPassword = false;
        }else if(  pass1.val() != pass2.val() ){
            alert("Contraseñas no coinciden");
            flagPassword = false;
        }

        if( pass1.val().length > 5 && pass1.val() == pass2.val() ){
			flagPassword = true;
		}

        if( flagPassword == true ){
            var data = { 'Email': $("#email").val() };
            var rtaExisteUsuario = solicitudAjax('validarUsuarioExiste', '', 'POST', data);
            if ( rtaExisteUsuario > 0 ){
                alert("Usuario ya existente");
                $("#email").focus();
            }else{
                var data = $("#formCrearUsuario").serialize();
                solicitudAjax('GuardarContacto', '', 'post', data);
                alert("Usuario registrado");
                $('#formCrearUsuario :input').val("");
            }
        }
    }

    
    function solicitudAjax(url, divResultado, method, data) {
        var result = '';
        $.ajax({
            //headers: { "X-CSRF-Token": $('input[name="_token"]').val() },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "../"+url,
            type: method,
            data: data,
            cache: false,
            success: function (data) {
                //alert(data);
                result = data;
            },
            error: function (data) {
                result = data.status;
            },
            async: false,
        });
        return result;
    }
    
</script>