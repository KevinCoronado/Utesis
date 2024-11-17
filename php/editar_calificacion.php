<?php
require_once 'conexion.php';
header('Content-Type: application/json');

try {
    
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $calificacion = isset($_POST['calificacion']) ? intval($_POST['calificacion']) : null;
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;


    if ($id > 0 && $calificacion !== null && $comentario !== null) {

        $query = "UPDATE revisiones_asesor SET calificacion = :calificacion, comentario = :comentario WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':calificacion', $calificacion, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Calificación actualizada correctamente."]);
        } else {
            echo json_encode(["success" => false, "error" => "Error al actualizar la calificación."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Datos incompletos para actualizar la calificación."]);
    }
} catch (PDOException $e) {

    echo json_encode(["success" => false, "error" => "Error en la base de datos: " . $e->getMessage()]);
}
?>
