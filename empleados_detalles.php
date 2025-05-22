<?php include("funciones/valida_sesion.php"); ?>
<?php
// empleados_detalles.php
include('menu.php');

$id     = $_REQUEST['id'];
$sql = "SELECT * FROM empleados WHERE eliminado = 0 AND id = $id";
$res = $con->query($sql);

$sql = "SELECT nombre, apellido, correo, rol, archivo_nombre, archivo_file FROM empleados WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre, $apellido, $correo, $rol, $archivoNombre, $archivoFile);
if ($stmt->fetch()) {
    // Asignar texto al rol
    $rol_txt = ($rol == 1) ? 'Gerente' : 'Ejecutivo';
} else {
     echo "Empleado no encontrado.";
    exit;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de <?php echo $nombre; ?></title>
    <link rel='stylesheet' href='empleados_detalles.css'>
</head>
<body>
    <button onclick="history.back()">Regresar</button>
    <div class='detalles_container'>
        <div class='detalles_table-container'>
            <div class='detalles_table-row header'> 
                <div class='detalles_table-cell'><h3>Detalles de <?php echo $nombre; ?></h3>
                    <?php if ($archivoFile): ?>
                        <p><strong>Archivo subido:</strong> <br>
                        <img class="detalles_img" src="archivos/<?php echo $archivoFile; ?>" alt="<?php echo $archivoNombre; ?>"> <a href="archivos/<?php echo $archivoFile; ?>" target="_blank"><?php echo $archivoNombre; ?></a></p>
                    <?php else: ?>
                        <p><strong>Archivo subido:</strong> <br>No se subió ningún archivo.</p>
                    <?php endif; ?>
                <strong>Nombre completo:</strong> <?php echo $nombre . ' ' . $apellido; ?><br>
                <strong>Correo:</strong> <?php echo $correo; ?><br>
                <strong>Cargo:</strong> <?php echo $rol_txt; ?><br>
                <strong>Status:</strong> Activo<br><br>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</body>
</html>