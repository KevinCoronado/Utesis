<?php
$host = 'localhost';       // Cambia esto si usas otro host
$dbname = 'utesis';        // Nombre de la base de datos
$username = 'root';        // Usuario de la base de datos
$password = '';            // Contraseña del usuario

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
