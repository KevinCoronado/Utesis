<?php
require_once 'conexion.php';
header('Content-Type: application/json');

try {

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id > 0) {

        $query = "DELETE FROM revisiones_asesor WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Calificación eliminada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró la calificación a eliminar.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID de calificación no válido.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Error al eliminar la calificación: ' . $e->getMessage()]);
}
?>
