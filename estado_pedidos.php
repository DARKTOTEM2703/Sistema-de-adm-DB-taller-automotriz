<?php
// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

// Dependiendo del tipo de usuario, mostrar diferentes botones
$rol = $_SESSION['rol'];
$id = $_SESSION['usuarioID'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Estado de Pedidos - Refaccionaria</title>
</head>

<body>
    <?php
    include 'head.php';
    ?>
    <div class="background ancho">
        <div class="contenedor-principal">
            <?php
            include 'menu.php';
            ?>
            <div class="contenido">
                <h2>Estado de Pedidos</h2>

                <?php
                // Incluir el archivo de conexión a la base de datos
                include("conn.php");
                // If para Consulta SQL para obtener todos los pedidos si es admin, si no solo los de su id
                if ($rol === 'Cliente') {
                    $consulta = "SELECT * FROM Venta WHERE clienteID ='$id'";
                    $resultado = mysqli_query($enlace, $consulta);
                    if (!$resultado) {
                        die("Error en la consulta: " . mysqli_error($enlace));
                    }
                } else {
                    $consulta = "SELECT * FROM Venta";
                    $resultado = mysqli_query($enlace, $consulta);
                    if (!$resultado) {
                        die("Error en la consulta: " . mysqli_error($enlace));
                    }
                }
                // Verificar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Mostrar los pedidos en una lista
                    echo "<ul>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<li class='light'><span class='bold'>ID de Venta:</span> " . $fila['ventaID'] . " - <span class='bold'>Cliente ID:</span> " . $fila['clienteID'] . " - <span class='bold'>Fecha de Venta:</span> " . $fila['fechaVenta'] . " - <span class='bold'>Total:</span> $" . $fila['total'];
                        echo "<ul>";
                        // Obtener los detalles de venta para esta venta
                        $consulta_detalles = "SELECT * FROM DetalleVenta WHERE ventaID = " . $fila['ventaID'];
                        $resultado_detalles = mysqli_query($enlace, $consulta_detalles);
                        // Mostrar los detalles de venta
                        while ($detalle = mysqli_fetch_assoc($resultado_detalles)) {
                            echo "<li class='light'><span class='bold'>Refacción ID:</span> " . $detalle['refaccionID'] . " - <span class='bold'>Cantidad:</span> " . $detalle['cantidad'] . " - <span class='bold'>Precio Unitario:</span> $" . $detalle['precioUnitario'] . " - <span class='bold'>Subtotal:</span> $" . $detalle['subtotal'] . "</li>";
                        }
                        echo "</ul></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No hay pedidos registrados.";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($enlace);
                ?>

                <!--  <br>
                <button onclick="location.href='index.php'">Regresar al Menú Principal</button> -->
            </div>
        </div>
        <?php
        include 'contacto.php';
        ?>
    </div>
</body>

</html>