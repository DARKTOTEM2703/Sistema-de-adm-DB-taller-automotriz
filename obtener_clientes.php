<?php
include("conn.php");

$consulta_clientes = "SELECT id, nombre FROM cliente";
$resultado_cliente = mysqli_query($enlace, $consulta_clientes);

if ($resultado_cliente) {
    while ($fila = mysqli_fetch_assoc($resultado_cliente)) {
        // Imprimir opciones con el ID y el nombre del cliente
        echo '<option value="' . $fila['id'] . '">' . $fila['id'] . ' - ' . $fila['nombre'] . '</option>';
    }
}

mysqli_close($enlace);
?>
