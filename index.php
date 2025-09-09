<?php
// Incluimos el archivo funciones.php
include ("funciones.php");

// Iniciamos la sesión
session_start();

// Desactivamos la notificación de errores
error_reporting(0); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Incluimos los estilos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Incluimos los estilos CSS personalizados -->
    <link rel="stylesheet" href="style.css">
    
    <style>
        body {
            background-color: #333333 !important;
        }
    </style>
</head>

<body>
    <!-- Creamos el formulario de inicio de sesión -->
    <form action="logeo.php" method="post" id="login-form">
        <section class="form-login">
            <!-- Insertamos el logo de la aplicación -->
            <div class="text-center">
                <img src="logo.png" alt="" width="100" height="100" class="rounded mx-auto d-block">
            </div>
            
            <!-- Campos de entrada para el usuario y la contraseña -->
            <input class="controls" type="text" name="usuario" id="usuario" value="" placeholder="Usuario">
            <input class="controls" type="password" name="contrasena" id="contrasena" value="" placeholder="Contraseña">
            
            <!-- Botón de envío de los datos del formulario -->
            <input class="buttons" type="submit" name="btn_acceder" value="Ingresar">
            
            <!-- Enlace para recuperar la contraseña -->
            <p><a href="#">¿Olvidaste tu Contraseña?</a></p>
        </section>
    </form>

    <!-- Incluimos los scripts JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</body>
</html>


