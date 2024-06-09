<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include 'conn.php'; // Asegúrate de que este archivo existe y se incluye correctamente

$tabla = $_GET['tabla'];

if (!empty($tabla)) {
    // Sanitiza el nombre de la tabla para evitar inyecciones SQL
    $tabla = mysqli_real_escape_string($enlace, $tabla);

    // Consulta para obtener los datos de la tabla seleccionada
    $query = "SELECT * FROM $tabla";
    $result = mysqli_query($enlace, $query);

    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array("error" => "Error al realizar la consulta"));
    }
} else {
    echo json_encode(array("error" => "No se ha seleccionado ninguna tabla"));
}
?>
