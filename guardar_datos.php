<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabla = $_POST['tabla'];

    if ($tabla == "Venta") {
        $fechaVenta = $_POST['fechaVenta'];
        $total = $_POST['total'];
        $clienteID = isset($_POST['idcliente']) ? $_POST['idcliente'] : 'NULL'; // Modificado para obtener el ID del cliente correctamente

        // Convertir clienteID en un entero para evitar problemas de inyección SQL
        $clienteID = intval($clienteID);

        // Insertar datos en la tabla venta
        $consulta_insertar_venta = "INSERT INTO venta (clienteID, fechaVenta, total) VALUES ($clienteID, '$fechaVenta', $total)";
        $resultado_insertar_venta = mysqli_query($enlace, $consulta_insertar_venta);

        if ($resultado_insertar_venta) {
            // Obtener el ID de la venta recién insertada
            $ventaID = mysqli_insert_id($enlace);

            // Verificar si se insertó el registro en venta
            if ($ventaID) {
                // Insertar detalles de la venta en detalleVenta
                $refaccionID = $_POST['refaccionID'];
                $cantidad = $_POST['cantidad'];
                $precioUnitario = $_POST['precioUnitario'];
                $subtotal = $_POST['subtotal'];

                // Iterar sobre los detalles de la venta y guardarlos en detalleVenta
                for ($i = 0; $i < count($refaccionID); $i++) {
                    $consulta_insertar_detalle = "INSERT INTO detalleVenta (ventaID, refaccionID, cantidad, precioUnitario, subtotal) VALUES ($ventaID, {$refaccionID[$i]}, {$cantidad[$i]}, {$precioUnitario[$i]}, {$subtotal[$i]})";
                    $resultado_insertar_detalle = mysqli_query($enlace, $consulta_insertar_detalle);
                    if (!$resultado_insertar_detalle) {
                        echo "Error al agregar detalles de la venta.";
                        exit;
                    }
                }

                // Redireccionar con un mensaje de éxito
                echo "<script>
                    alert('Venta agregada correctamente.');
                    window.location.href='agregar.php';
                    </script>";
            } else {
                echo "Error al obtener el ID de la venta recién insertada.";
            }
        } else {
            echo "Error al agregar la venta.";
        }
    } else {
        // Insertar datos en la tabla correspondiente
        $datos = array();
        foreach ($_POST as $key => $value) {
            if ($key != 'tabla') {
                $datos[$key] = $value;
            }
        }

        $columnas = implode(", ", array_keys($datos));
        $valores = "'" . implode("', '", array_values($datos)) . "'";
        $consulta_insertar = "INSERT INTO $tabla ($columnas) VALUES ($valores)";

        $resultado_insertar = mysqli_query($enlace, $consulta_insertar);

        if ($resultado_insertar) {
            echo "<script>
                alert('Datos agregados correctamente.');
                window.location.href='agregar.php';
                </script>";
        } else {
            echo "Error al agregar los datos.";
        }
    }
}

mysqli_close($enlace);
?>
