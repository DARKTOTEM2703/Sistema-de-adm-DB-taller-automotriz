<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consulta de Refacciones - Refaccionaria</title>
</head>

<?php
include 'rol.php';
?>

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
                <h2>Consulta de Refacciones</h2>

                <?php
                // Incluir el archivo de conexión a la base de datos
                include("conn.php");

                // Consulta SQL para obtener todas las refacciones
                $consulta = "SELECT * FROM Refaccion";
                $resultado = mysqli_query($enlace, $consulta);

                // Verificar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Mostrar los resultados en una tabla HTML
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Cantidad en Inventario</th><th>Proveedor ID</th><th>Fecha de Adquisición</th></tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        // Verificar si la clave 'id' está definida en la fila
                        if (isset($fila['id'])) {
                            echo "<td class='amarillo'>" . $fila['id'] . "</td>";
                        } else {
                            echo "<td class='amarillo'>-</td>";
                        }
                        echo "<td class='blanco'>" . $fila['nombre'] . "</td>";
                        echo "<td class='blanco'>" . $fila['descripcion'] . "</td>";
                        echo "<td class='blanco'>" . $fila['precio'] . "</td>";
                        echo "<td class='blanco'>" . $fila['cantidadEnInventario'] . "</td>";
                        echo "<td class='blanco'>" . $fila['proveedorID'] . "</td>";
                        echo "<td class='blanco'>" . $fila['fechaAdquisicion'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No se encontraron refacciones.";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($enlace);
                ?>

                <!--    <br>
            <button onclick="location.href='index.php'">Regresar al Menú Principal</button> -->
            </div>
        </div>
        <?php
        include 'contacto.php';
        ?>
    </div>
</body>

</html>
