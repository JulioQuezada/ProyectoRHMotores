<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está iniciada antes de destruirla
if (session_status() === PHP_SESSION_ACTIVE) {
  // Liberar todas las variables de sesión registradas
  session_unset();
  // Destruir la sesión
  session_destroy();
}

// Redirigir al usuario a la página de inicio
header("Location: index.php");
exit();
?>
