<?php
// Se incluye el archivo de funciones que contiene la función conectar()
include("funciones.php");

// Se establece la conexión a la base de datos
$cnn = conectar();

// Se comprueba si se ha enviado el formulario y si el usuario y la contraseña no están en blanco
if(isset($_POST["btn_acceder"]) && !empty($_POST["usuario"]) && !empty($_POST["contrasena"])){

    // Se obtienen el usuario y la contraseña enviados por el formulario
    $usuario = $_POST["usuario"];
    $pass = $_POST["contrasena"];

    // Se prepara la consulta SQL con una consulta preparada para evitar la inyección de SQL
    $consulta = mysqli_prepare($cnn, "SELECT * FROM cuentas WHERE usuario=?");
    mysqli_stmt_bind_param($consulta, "s", $usuario);
    mysqli_stmt_execute($consulta);
    $rs = mysqli_stmt_get_result($consulta);

    // Si se ha encontrado un usuario con el nombre de usuario ingresado
    if(mysqli_num_rows($rs) > 0){

        // Se obtiene el hash de la contraseña almacenado en la base de datos
        $row = mysqli_fetch_assoc($rs);
        $hash = $row["contrasena"];

        // Se verifica si la contraseña ingresada coincide con el hash almacenado en la base de datos
        if(password_verify($pass, $hash)){

            // Se inicia la sesión y se establecen las variables de sesión
            session_start();
            $_SESSION["ESTADO"] = "LOGEADO";
            $_SESSION["usuario"] = $row["usuario"];
            $_SESSION["rol"] = $row["id_rol"];

            // Si el usuario tiene el rol de administrador, se redirige al menú de administrador
            if($_SESSION["rol"] == 1){
                header("location:menuadmin.php");
            }
            // Si el usuario tiene el rol de usuario normal, se redirige al menú de usuario normal
            elseif($_SESSION["rol"] == 2){
                header("location:menu.php"); 
            }
        }
        // Si la contraseña ingresada no coincide con el hash almacenado en la base de datos, se redirige al index.php
        else{
            header("location:index.php");
        }
    }
    // Si no se ha encontrado un usuario con el nombre de usuario ingresado, se redirige al index.php
    else{
        header("location:index.php");
    }
}
// Si el formulario no se ha enviado o si el usuario o la contraseña están en blanco, se redirige al index.php
else{
    header("location:index.php");
}



