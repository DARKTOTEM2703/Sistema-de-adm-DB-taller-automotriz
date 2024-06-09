<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consulta de Existencias - Refaccionaria</title>
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
                <h2>Consulta de Existencias</h2>

                <?php
                // Incluir el archivo de conexión a la base de datos
                include("conn.php");

                // Consulta SQL para obtener la suma de la cantidad en inventario de cada refacción
                $consulta = "SELECT r.nombre AS Nombre, SUM(r.cantidadEnInventario) AS Existencias 
                 FROM Refaccion r 
                 GROUP BY r.nombre";
                $resultado = mysqli_query($enlace, $consulta);

                // Verificar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Mostrar los resultados en una tabla HTML
                    echo "<table>";
                    echo "<tr><th>Nombre</th><th>Existencias</th></tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td class='blanco'>" . $fila['Nombre'] . "</td>";
                        echo "<td class='blanco'>" . $fila['Existencias'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No se encontraron existencias.";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($enlace);
                ?>

                <!-- <br>
                <button onclick="location.href='index.php'">Regresar al Menú Principal</button> -->
            </div>
        </div>
        <?php
        include 'contacto.php';
        ?>
    </div>
</body>

</html>