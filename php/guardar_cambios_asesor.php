<?php
require_once 'conexion.php';

try {
    // Leer los datos enviados en formato JSON
    $data = json_decode(file_get_contents("php://input"), true);

    $nombre = $data['nombre'];
    $email = $data['email'];
    $password = $data['password'];
    $id_asesor = $_SESSION['id'] // Asegúrate de obtener el ID correcto

    // Preparar la consulta de actualización
    $stmt = $conexion->prepare("UPDATE asesores SET nombre = :nombre, correo = :email, clave = :password WHERE id = :id_asesor");
    $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':id_asesor', $id_asesor, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al actualizar los datos."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Error en la base de datos: " . $e->getMessage()]);
}
?>
