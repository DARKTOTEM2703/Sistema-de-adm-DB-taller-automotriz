<?php
include 'conn.php'; // Asegúrate de que este archivo existe y se incluye correctamente

// Establecer el encabezado para la respuesta JSON
header('Content-Type: application/json');

// Obtener los datos de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$tabla = $data['tabla'];
$idAttribute = $data['idAttribute']; // Recibir idAttribute desde la solicitud

if (!empty($id) && !empty($tabla)) {
    // Sanitizar los datos
    $id = mysqli_real_escape_string($enlace, $id);
    $tabla = mysqli_real_escape_string($enlace, $tabla);

    // Consulta para eliminar el elemento
    $query = "DELETE FROM $tabla WHERE $idAttribute = '$id'";
    if (mysqli_query($enlace, $query)) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("error" => "Error al eliminar el elemento: " . mysqli_error($enlace)));
    }
} else {
    echo json_encode(array("error" => "Datos incompletos para eliminar el elemento"));
}
?>
