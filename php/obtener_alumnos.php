<?php
// obtener_alumnos.php
include 'conexion.php';

try {
    // Obtener el id del asesor actual (puedes ajustarlo según sea necesario)
    $idAsesor = $_SESSION['id']; // Reemplaza con el ID real del asesor que corresponda

    // Consulta para obtener los alumnos asignados al asesor
    $query = $conexion->prepare("SELECT id, nombre, carrera, grado, grupo, turno FROM usuarios WHERE id_asesor = :id_asesor");
    $query->bindParam(':id_asesor', $idAsesor, PDO::PARAM_INT);
    $query->execute();
    $alumnos = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($alumnos);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
