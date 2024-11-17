<?php
include 'conexion.php';
header('Content-Type: application/json');


if (isset($_GET['id'])) {
    $id_alumno = $_GET['id'];




    $query = $conexion->prepare("SELECT id,semana,calificacion,comentario FROM revisiones_asesor WHERE id_alumno = :id_alumno");
    $query->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);
    $query->execute();
    $calificaciones = $query->fetchAll(PDO::FETCH_ASSOC);



    echo json_encode($calificaciones);


} else {
    echo json_encode(["error" => "ID de alumno no proporcionado"]);
}
?>
