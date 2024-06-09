<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Actualizar los datos del proveedor en la base de datos
    $consulta_actualizar = "UPDATE Proveedor SET nombre='$nombre', direccion='$direccion', telefono='$telefono', email='$email' WHERE id='$id'";
    $resultado_actualizar = mysqli_query($enlace, $consulta_actualizar);

    if ($resultado_actualizar) {
        /* //echo "Datos actualizados correctamente. Redirigiendo...";
        header("refresh:0.1; url=editar.php?"); // Redirección después de 2 segundos */
        echo
        "<script>
            alert('Datos actualizados correctamente.');
            window.location.href='editar.php';
        </script>";
    } else {
        echo "Error al actualizar los datos.";
    }
}

mysqli_close($enlace);
?>
