<?php
include 'conexion.php';
header('Content-Type: application/json');

// Verificar si el parámetro 'id' está presente en la solicitud
if (isset($_GET['id'])) {
    $id_alumno = $_GET['id'];



    // Obtener las calificaciones del alumno
    $query = $conexion->prepare("SELECT id,semana,calificacion,comentario FROM revisiones_asesor WHERE id_alumno = :id_alumno");
    $query->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);
    $query->execute();
    $calificaciones = $query->fetchAll(PDO::FETCH_ASSOC);


    // Responder con las calificaciones en formato JSON
    echo json_encode($calificaciones);


} else {
    echo json_encode(["error" => "ID de alumno no proporcionado"]);
}
?>
