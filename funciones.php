<?php
function Conectar()
{
    // Establecer la configuración de la conexión
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "rhmotors";

    // Establecer la conexión
    $cnn = mysqli_connect($servidor, $usuario, $contrasena, $base_de_datos);

    // Verificar si la conexión es válida
    if (!$cnn) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    return $cnn;
}
?>

