<?php
// empleados_actualiza.php
require_once 'funciones/conecta.php';
$con = conecta();

// Recibir datos del formulario
$id       = $_POST['id'];
$nombre   = $_POST['nombre'];
$apellidos= $_POST['apellidos'];
$correo   = $_POST['correo'];
$pass     = $_POST['pass'];
$rol      = $_POST['rol'];
$archivoNombre = $_POST['archivo_nombre'];

// Verificar si se subió nuevo archivo
$archivoFile = '';
if (isset($_FILES['archivo']) && $_FILES['archivo']['name'] != '') {
    $archivoFile = $_FILES['archivo']['name'];
    $archivoTmp  = $_FILES['archivo']['tmp_name'];
    move_uploaded_file($archivoTmp, "archivos/$archivoFile");
    
    // Actualizar con archivo
    $sql = "UPDATE empleados SET nombre=?, apellido=?, correo=?, rol=?, archivo_nombre=?, archivo_file=?";

    // Incluir password si fue proporcionada
    if ($pass != '') {
        $passEnc = md5($pass);
        $sql .= ", pass=?";
        $sql .= " WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssssi", $nombre, $apellidos, $correo, $rol, $archivoNombre, $archivoFile, $passEnc, $id);
    } else {
        $sql .= " WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $apellidos, $correo, $rol, $archivoNombre, $archivoFile, $id);
    }

} else {
    // Sin nuevo archivo
    $sql = "UPDATE empleados SET nombre=?, apellido=?, correo=?, rol=?, archivo_nombre=?";
    
    // Incluir password si fue proporcionada
    if ($pass != '') {
        $passEnc = md5($pass);
        $sql .= ", pass=?";
        $sql .= " WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $apellidos, $correo, $rol, $archivoNombre, $passEnc, $id);
    } else {
        $sql .= " WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $apellidos, $correo, $rol, $archivoNombre, $id);
    }
}

// Ejecutar y redirigir
$stmt->execute();
$stmt->close();

header("Location: empleados_lista.php");
exit;
?>