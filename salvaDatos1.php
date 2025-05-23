<?php
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];
    //$rol = $_GET('rol');
    //$rol = $_REQUEST('rol');
    $rol_txt = ($rol == 1) ? 'Gerente' : 'Ejecutivo';

    echo "Bienvenido $correo <br>";
    echo "$pass / $rol_txt";
    echo "<br><br>";
?>