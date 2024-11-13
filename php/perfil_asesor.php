<?php
require_once 'conexion.php';

try {
    $id_asesor = $_SESSION['id']; // Asegúrate de usar un valor válido o recibir el ID del asesor de alguna manera

    $stmt = $conexion->prepare("SELECT nombre, correo, clave FROM asesores WHERE id = :id_asesor");
    $stmt->bindValue(':id_asesor', $id_asesor, PDO::PARAM_INT); // Correcto para PDO
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "Asesor no encontrado"]);
    }

} catch (PDOException $e) {
    echo json_encode(["error" => "Error en la consulta: " . $e->getMessage()]);
}
?>
