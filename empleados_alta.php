<?php include("funciones/valida_sesion.php"); ?>
<?php
//empleados_alta.php
include('menu.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Empleados</title>
    <link rel='stylesheet' href='empleados_alta.css'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    let correoValido = true; 
    $(document).ready(function () {
        $('#correo').on('blur', function () {
            var correo = $(this).val();
            if (correo !== '') {
                $.ajax({
                    url: 'funciones/verificar_correo.php',
                    type: 'POST',
                    data: { correo: correo },
                    success: function (respuesta) {
                        console.log('Respuesta AJAX:', respuesta);

                        if (respuesta.trim() === 'existe') {
                            correoValido = false;
                            $('#correo-error').text('El correo ' + correo + ' ya existe.').show();
                            setTimeout(function () {
                                $('#correo-error').fadeOut();
                            }, 5000);
                        } else {
                            correoValido = true;
                        }
                    }
                });
            }
        });
        $('#forma01').on('submit', function(e) {
            e.preventDefault();

            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            var rol = $('#rol').val();
            var archivo = $('#archivo').val();

            if(nombre === '' || apellidos === '' || correo === '' || !correo.includes('@') || pass === '' || rol === '0' || archivo === '') {
                $('#error-message').text('Faltan campos por llenar').show();
                setTimeout(function() {
                    $('#error-message').fadeOut();
                }, 5000);
                return false;
            }

            if (!correoValido) {
                $('#correo-error').text('No puedes usar un correo duplicado.').show();
                setTimeout(function () {
                    $('#correo-error').fadeOut();
                }, 5000);
                return false;
            }

            this.submit();
        });
    });
    </script>
</head>
<body>
    <button onclick="history.back()">Regresar</button>
    <div class='alta-container'>
        <div class='alta-table-container'>
            <div class='alta-table-row header'>
                <div class='alta-table-cell'><h3>Alta de Empleados</h3></div>
            </div>

            <div class='alta-table-row body'>
                <div class='alta-table-cell'>
                    <form id="forma01" name="forma01" method="post" action="empleados_salva.php" enctype="multipart/form-data">
                        <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre"/><br>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos"/><br>
                        <input type="text" name="correo" id="correo" placeholder="Escribe tu correo"/>
                        <span id="correo-error" class="error-message" style="display:none; color:red;"></span><br>
                        <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña"/><br><br>
                        <input type="file" id="archivo" name="archivo"><br><br>
                        <select name="rol" id="rol">
                            <option value="0">Selecciona rol</option>
                            <option value="1">Gerente</option>
                            <option value="2">Ejecutivo</option>
                        </select><br><br>
                        <input type="submit" value="Guardar"/>
                        <div id="error-message" class="error-message" style="display:none; color:red;"></div>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
    </div>
</body>
</html>