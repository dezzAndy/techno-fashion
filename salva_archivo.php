<?php
//salva_archivo.php
//Cachar variables
$nombre_original    = $_FILES['archivo']['name'];
$ruta_temporal      = $_FILES['archivo']['tmp_name'];

//Obtener extension
$arreglo    = explode(".", $nombre_original);
$len        = count($arreglo);
$pos        = $len - 1;
$ext        = $arreglo[$pos];

//Carpeta para guardar archivos
$dir        = "archivos/";

//obtener nombre
$cadena_encriptada  = md5_file($ruta_temporal);
$nuevo_nombre       = "$cadena_encriptada.$ext";

echo "Nombre original:      $nombre_original<br>";
echo "Ruta temporal:        $ruta_temporal<br>";
echo "Extensión:            $ext<br>";
echo "Cadena encriptada:    $cadena_encriptada<br>";
echo "Nuevo nombre:         $nuevo_nombre<br>";

copy($ruta_temporal, $dir.$nuevo_nombre);

?>
