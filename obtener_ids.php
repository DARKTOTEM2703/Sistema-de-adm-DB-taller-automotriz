<?php
include("conn.php");

// Verificar si se ha recibido el parámetro 'tabla'
if(isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];

    // Generar la consulta SQL para obtener todos los IDs de la tabla seleccionada
    $consulta = "SELECT {$tabla}ID FROM $tabla";
    $resultado = mysqli_query($enlace, $consulta);

    // Crear un array para almacenar los IDs
    $ids = array();

    // Iterar sobre los resultados y agregar cada ID al array
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $ids[] = $fila["{$tabla}ID"];
    }

    // Devolver los IDs como datos JSON
    echo json_encode($ids);
} else {
    echo "Error: No se ha especificado una tabla.";
}

mysqli_close($enlace);
?>
