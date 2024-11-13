<?php
require_once 'conexion.php';
header('Content-Type: application/json');

try {
    // Obtener los datos enviados desde JavaScript o la URL
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $calificacion = isset($_POST['calificacion']) ? intval($_POST['calificacion']) : null;
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;

    // Validar que los datos estén completos
    if ($id > 0 && $calificacion !== null && $comentario !== null) {
        // Preparar y ejecutar la consulta de actualización
        $query = "UPDATE revisiones_asesor SET calificacion = :calificacion, comentario = :comentario WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':calificacion', $calificacion, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Calificación actualizada correctamente."]);
        } else {
            echo json_encode(["success" => false, "error" => "Error al actualizar la calificación."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Datos incompletos para actualizar la calificación."]);
    }
} catch (PDOException $e) {
    // Manejo de errores de la base de datos
    echo json_encode(["success" => false, "error" => "Error en la base de datos: " . $e->getMessage()]);
}
?>
