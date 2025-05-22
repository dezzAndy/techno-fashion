<?php
require "conecta.php";
$con = conecta();
session_start();

$correo = $_POST['correo'];
$pass   = $_POST['pass'];

$pass = md5($pass);

$sql = "SELECT id, nombre, correo FROM empleados 
        WHERE correo = '$correo' 
        AND pass = '$pass'
        AND eliminado = 0";

$res = $con->query($sql);

if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();

    // Guardar variables en la sesión
    $_SESSION['userID']    = $row['id'];
    $_SESSION['userName']  = $row['nombre'];
    $_SESSION['userEmail'] = $row['correo'];

    echo "existe";
} else {
    echo "no_existe";
}
?>