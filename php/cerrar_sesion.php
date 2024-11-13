<?php
// cerrar_sesion.php
session_start();
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al usuario a la página de inicio
header("Location: ../index.html");
exit();
?>
