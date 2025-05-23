<?php include("funciones/valida_sesion.php"); ?>
<?php
// dashboard.php
include('menu.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel='stylesheet' href='dashboard.css'>
</head>
<body>
    <div class='dashboard-container'>
        <div class='dashboard-table-container'>
            <div class='dashboard-table-row body'>
                <div class='dashboard-table-cell'>
                    <div class='rainbow-text'><h1>Hola <?php echo $nombre_sesion; ?>, bienvenid@ al sistema! :3</h1></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
