<?php
//empleados_elimina.php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

//$sql = "DELETE * FROM empleados WHERE id = $id";
$sql = "UPDATE empleados SET eliminado = 1 WHERE id = $id";
$res = $con->query($sql);

header("Location: empleados_lista.php");

?>