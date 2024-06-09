<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consultar Datos - Refaccionaria</title>
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
                <h2>Consulta de Proveedores</h2>

                <?php
                include("conn.php");

                // Consulta para obtener los datos de la tabla Proveedor
                $consulta_proveedor = "SELECT * FROM Proveedor";
                $resultado_proveedor = mysqli_query($enlace, $consulta_proveedor);

                // Mostrar los resultados en una tabla
                if (mysqli_num_rows($resultado_proveedor) > 0) {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Email</th></tr>";
                    while ($row = mysqli_fetch_assoc($resultado_proveedor)) {
                        echo "<tr>";
                        echo "<td class='amarillo'>" . $row["id"] . "</td>";
                        echo "<td class='blanco'>" . $row["nombre"] . "</td>";
                        echo "<td class='blanco'>" . $row["direccion"] . "</td>";
                        echo "<td class='blanco'>" . $row["telefono"] . "</td>";
                        echo "<td class='blanco'>" . $row["email"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No hay proveedores registrados.";
                }

                // Similar consulta y visualización para otras tablas...

                mysqli_close($enlace);
                ?>
<!-- 
                <br>
                <button onclick="location.href='index.php'">Regresar al Menú Principal</button> -->
            </div>
        </div>

        <?php
        include 'contacto.php';
        ?>
    </div>
</body>

</html>