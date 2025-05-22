<?php include("funciones/valida_sesion.php"); ?>
<?php
// empleados_editar.php
include('menu.php');
require_once 'funciones/conecta.php';
$con = conecta();

$id = $_REQUEST['id'];
$sql = "SELECT nombre, apellido, correo, rol, archivo_nombre, archivo_file FROM empleados WHERE id = $id AND eliminado = 0";
$res = $con->query($sql);
if ($res->num_rows == 0) {
    echo "Empleado no encontrado.";
    exit;
}
$row = $res->fetch_assoc();

$nombre     = $row['nombre'];
$apellidos  = $row['apellido'];
$correo     = $row['correo'];
$rol        = $row['rol'];
$archivoNombre = $row['archivo_nombre'];
$archivoFile   = $row['archivo_file'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Edición de Empleados</title>
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
                    data: { correo: correo, id: <?php echo $id; ?> },
                    success: function (respuesta) {
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
            var rol = $('#rol').val();

            if(nombre === '' || apellidos === '' || correo === '' || !correo.includes('@') || rol === '0') {
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
                <div class='alta-table-cell'><h3>Edición de Empleados</h3></div>
            </div>

            <div class='alta-table-row body'>
                <div class='alta-table-cell'>
                    <form id="forma01" name="forma01" method="post" action="empleados_actualiza.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" placeholder="Escribe tu nombre"/><br>
                        <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" placeholder="Escribe tus apellidos"/><br>
                        <input type="text" name="correo" id="correo" value="<?php echo $correo; ?>" placeholder="Escribe tu correo"/>
                        <span id="correo-error" class="error-message" style="display:none; color:red;"></span><br>
                        <input type="password" name="pass" id="pass" placeholder="Escribe nueva contraseña (opcional)"/><br><br>

                        <?php if ($archivoFile): ?>
                            <p><strong>Archivo actual:</strong> <a href="archivos/<?php echo $archivoFile; ?>" target="_blank"><?php echo $archivoNombre; ?></a></p>
                        <?php else: ?>
                            <p><strong>No hay archivo subido.</strong></p>
                        <?php endif; ?>
                        
                        <input type="file" id="archivo" name="archivo"><br><br>
                        
                        <label for="archivo_nombre">Nombre del archivo:</label><br>
                        <input type="text" id="archivo_nombre" name="archivo_nombre" value="<?php echo $archivoNombre; ?>"><br><br>

                        <select name="rol" id="rol">
                            <option value="0">Selecciona rol</option>
                            <option value="1" <?php if ($rol == 1) echo 'selected'; ?>>Gerente</option>
                            <option value="2" <?php if ($rol == 2) echo 'selected'; ?>>Ejecutivo</option>
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
