<?php
// verificar_correo.php

require "conecta.php";
$con = conecta();

if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Verificación en modo edición (excluye el ID actual)
        $stmt = $con->prepare("SELECT COUNT(*) FROM empleados WHERE correo = ? AND id != ? AND eliminado = 0");
        $stmt->bind_param("si", $correo, $id);
    } else {
        // Verificación en modo alta
        $stmt = $con->prepare("SELECT COUNT(*) FROM empleados WHERE correo = ? AND eliminado = 0");
        $stmt->bind_param("s", $correo);
    }

    $stmt->execute();
    $stmt->bind_result($existe);
    $stmt->fetch();
    $stmt->close();

    if ($existe > 0) {
        echo 'existe';
    }
}
?>
