<?php include("funciones/valida_sesion.php"); ?>
<?php
//empleados_lista.php
echo "<head>";
include('menu.php');
echo "<head>
        <script>
        function confirmarEliminacion(id) {
            if (confirm('¿Estás seguro que deseas eliminar este empleado?')) {
                window.location.href = 'empleados_elimina.php?id=' + id;
            }
        }
        </script>";
echo "</head>";


$sql = "SELECT * FROM empleados WHERE eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;

// Enlazar el archivo CSS
echo "<link rel='stylesheet' href='empleados_lista.css'>";

// Contenedor principal
echo "<div class='container'>";

echo "<h3>Lista de Empleados ($num)</h3>";

// Contenedor que simula una tabla
echo "<div class='table-container'>";

// Cabecera de la "tabla"
echo "<div class='table-row header'>";
echo "<div class='table-cell'>ID</div>";
echo "<div class='table-cell'>Nombre</div>";
echo "<div class='table-cell'>Correo</div>";
echo "<div class='table-cell'>Rol</div>";
echo "<div class='table-cell'>Detalles</div>";
echo "<div class='table-cell'>Editar</div>";
echo "<div class='table-cell'>Eliminar</div>";

echo "</div>"; // Fin de la cabecera

while($row = $res->fetch_array()) {
    $id     = $row["id"];
    $nombre = $row["nombre"].' '.$row["apellido"];
    $correo = $row["correo"];
    $rol    = $row["rol"];
    $rol_txt = ($rol == 1) ? 'Gerente' : 'Ejecutivo';

    // Fila de la "tabla"
    echo "<div class='table-row'>";
    echo "<div class='table-cell'>$id</div>";
    echo "<div class='table-cell'>$nombre</div>";
    echo "<div class='table-cell'>$correo</div>";
    echo "<div class='table-cell'>$rol_txt</div>";
    echo "<div class='table-cell'><a href=\"empleados_detalles.php?id=$id\">Ver detalles</a></div>";
    echo "<div class='table-cell'><a href=\"empleados_editar.php?id=$id\">Editar</a></div>";
    echo "<div class='table-cell'><a href=\"javascript:void(0);\" onclick=\"confirmarEliminacion($id)\">Eliminar</a></div>";
    echo "</div>"; // Fin de la fila
}

echo "</div>"; // Fin del contenedor que simula la tabla

echo "</div>"; // Fin del contenedor principal

// Enlace para crear nuevo registro
echo "<a href='./empleados_alta.php'>Crear nuevo registro</a><br><br>";

?>