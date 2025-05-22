<?php
// menu.php
require "funciones/conecta.php";
$con = conecta();
$nombre_sesion = $_SESSION['userName'];

echo "<link rel='stylesheet' href='menu.css'>";

// Contenedor principal
echo "<div class='menu-container'>";

// Contenedor de tabla
echo "<div class='menu-table-container'>";

// Cabecera
echo "<div class='menu-table-row header'>";
echo "<div class='menu-table-cell'><a href=\"dashboard.php\">Inicio</a></div>";
echo "<div class='menu-table-cell'><a href=\"empleados_lista.php\">Empleados</a></div>";//empleados_alta.php
echo "<div class='menu-table-cell'><a>Productos</a></div>";
echo "<div class='menu-table-cell'><a>Promociones</a></div>";
echo "<div class='menu-table-cell'><a>Pedidos</a></div>";
echo "<div class='menu-table-cell'>Hola $nombre_sesion!</div>";
echo "<div class='menu-table-cell'><a href='funciones/cerrar_sesion.php'>Cerrar sesión</a></div>";

echo "</div>"; // Fin de la cabecera

echo "</div>"; // Fin del contenedor principal
?>

<?php
//incluir menu:
//include('menu.php');
?>