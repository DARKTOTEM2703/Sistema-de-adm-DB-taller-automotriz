<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor - Refaccionaria</title>
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
                <h2>Editar Proveedor</h2>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <label for="id">Seleccione un proveedor:</label>
                    <select name="id" class="select">
                        <option value="" disabled selected hidden>Seleccione un Proveedor</option>
                        <?php
                        include("conn.php");

                        // Consulta para obtener todos los proveedores existentes
                        $consulta_proveedores = "SELECT id, nombre FROM Proveedor";
                        $resultado_proveedores = mysqli_query($enlace, $consulta_proveedores);

                        if (mysqli_num_rows($resultado_proveedores) > 0) {
                            while ($row = mysqli_fetch_assoc($resultado_proveedores)) {
                                echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay proveedores</option>";
                        }

                        mysqli_close($enlace);
                        ?>
                    </select>
                    <input type="submit" value="Editar">
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                    $id = $_GET['id'];

                    include("conn.php");

                    // Consulta para obtener los datos del proveedor a editar
                    $consulta_proveedor = "SELECT * FROM Proveedor WHERE id = $id";
                    $resultado_proveedor = mysqli_query($enlace, $consulta_proveedor);

                    if (mysqli_num_rows($resultado_proveedor) === 1) {
                        $row = mysqli_fetch_assoc($resultado_proveedor);

                        // Formulario para editar los datos del proveedor
                        echo "<form action='actualizar.php' method='post'>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<p class='txagregar'>Nombre:</p> <input type='text' name='nombre' value='" . $row["nombre"] . "'><br>";
                        echo "<p class='txagregar'>Dirección:</p> <input type='text' name='direccion' value='" . $row["direccion"] . "'><br>";
                        echo "<p class='txagregar'>Teléfono:</p> <input type='text' name='telefono' value='" . $row["telefono"] . "'><br>";
                        echo "<p class='txagregar'>Email:</p> <input type='text' name='email' value='" . $row["email"] . "'><br>";
                        echo "<input type='submit' value='Guardar'>";
                        echo "</form>";
                    } else {
                        echo "Proveedor no encontrado.";
                    }

                    mysqli_close($enlace);
                }
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