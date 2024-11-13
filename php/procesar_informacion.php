<?php
include 'conexion.php';
header('Content-Type: application/json');

try {
    // Obtener el id del alumno desde la URL
    if (isset($_GET['id'])) {
        $id_alumno = intval($_GET['id']);
    } else {
        echo json_encode(["error" => "ID del alumno no especificado"]);
        exit;
    }

    // Recibir datos de POST (los valores de ejemplo puedes reemplazarlos en producción)
    $semana = $_POST['semana'] ?? 3;
    $calificacion = $_POST['calificacion'] ?? 10;
    $comentario = $_POST['comentario'] ?? 'bien';
    $id_asesor = 1;

    if (empty($semana) || empty($calificacion)) {
        echo json_encode(["error" => "Todos los campos son requeridos"]);
        exit;
    }

    // Insertar la calificación en la base de datos
    $sql = "INSERT INTO revisiones_asesor (id_alumno, id_asesor, semana, calificacion, comentario) 
            VALUES (:id_alumno, :id_asesor, :semana, :calificacion, :comentario)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':id_alumno' => $id_alumno,
        ':id_asesor' => $id_asesor,
        ':semana' => $semana,
        ':calificacion' => $calificacion,
        ':comentario' => $comentario
    ]);

    echo json_encode(["success" => "Calificación registrada con éxito"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al registrar la calificación: " . $e->getMessage()]);
}
?>
