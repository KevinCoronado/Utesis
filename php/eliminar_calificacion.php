<?php
require_once 'conexion.php';
header('Content-Type: application/json');

try {
    // Obtener el ID de la calificación a eliminar
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id > 0) {
        // Preparar y ejecutar la consulta de eliminación
        $query = "DELETE FROM revisiones_asesor WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Verificar si se eliminó correctamente
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
