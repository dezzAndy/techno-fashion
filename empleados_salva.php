<?php
//empleados_salva.php
require "funciones/conecta.php";
$con = conecta();

// Verificar si el correo existe
$correo = $_POST['correo'];
$sql_check = "SELECT id FROM empleados WHERE correo = '$correo' AND eliminado = 0";
$res_check = $con->query($sql_check);

if ($res_check->num_rows > 0) {
    header("Location: empleados_alta.php?error=El correo $correo ya existe");
    exit;
}

// Proceder con el registro
$nombre     = $_POST['nombre'];
$apellidos  = $_POST['apellidos'];
$pass       = $_POST['pass'];
$rol        = $_POST['rol'];

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $nombre_original = $_FILES['archivo']['name'];
    $ruta_temporal = $_FILES['archivo']['tmp_name'];
    
    $ext = pathinfo($nombre_original, PATHINFO_EXTENSION);
    $cadena_encriptada = md5_file($ruta_temporal);
    $nuevo_nombre = "$cadena_encriptada.$ext";
    
    $dir = "archivos/";
    move_uploaded_file($ruta_temporal, $dir.$nuevo_nombre);
    
    $archivo_n = $nombre_original;
    $archivo = $nuevo_nombre;
} else {
    $archivo_n = '';
    $archivo = '';
}

$passEnc = md5($pass);

$sql = "INSERT INTO empleados 
        (nombre, apellido, correo, pass, rol, archivo_nombre, archivo_file)
        VALUES('$nombre', '$apellidos', '$correo', '$passEnc', '$rol', '$archivo_n', '$archivo')";
$res = $con->query($sql);

header("Location: empleados_lista.php");
?>