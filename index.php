<?php
// index.php
session_start();
if (isset($_SESSION['userID'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="index-container">
        <div class="index-table-container">
            <div class="index-table-row header">
                <div class="index-table-cell">
                    <h3>Inicia sesión</h3>
                </div>
            </div>
            <div class="index-table-row">
                <div class="index-table-cell">
                    <form id="loginForm">
                        <input type="text" id="correo" name="correo" placeholder="Correo">
                        <input type="password" id="pass" name="pass" placeholder="Contraseña">
                        <input type="submit" value="Entrar">
                        <div id="mensaje" class="error-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            var correo = $('#correo').val().trim();
            var pass = $('#pass').val().trim();

            if (correo === '' || pass === '') {
                $('#mensaje').text('Todos los campos son obligatorios.');
                return;
            }

            $.ajax({
                url: 'funciones/valida_login.php',
                type: 'POST',
                data: { correo: correo, pass: pass },
                success: function (respuesta) {
                    if (respuesta.trim() === 'existe') {
                        window.location.href = 'dashboard.php';
                    } else {
                        $('#mensaje').text('Usuario o contraseña incorrectos.');
                    }
                }
            });
        });
    });
    </script>
</body>
</html>
