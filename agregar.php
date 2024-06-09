<?php
// Verificar si el usuario ha iniciado sesión
session_start();

// Dependiendo del tipo de usuario, mostrar diferentes botones
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Datos - Refaccionaria</title>
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
                <h2>Agregar Datos</h2>

                <form action="guardar_datos.php" method="POST">
                    <label for="tabla">Seleccione la tabla:</label>
                    <select name="tabla" id="tabla" class="select">
                        <option value="" disabled selected hidden>Seleccione una tabla</option>
                        <?php if ($rol === 'Agente de ventas') : ?>
                            <option value="Venta">Venta</option>
                        <?php else : ?>
                            <option value="Proveedor">Proveedor</option>
                            <option value="Refaccion">Refaccion</option>
                            <option value="Cliente">Cliente</option>
                        <?php endif; ?>
                    </select><br>

                    <!-- Script para mostrar campos correspondientes a la tabla seleccionada -->
                    <script>
                        document.getElementById('tabla').addEventListener('change', function() {
                            var tablaSeleccionada = this.value;
                            var campos = document.getElementById('campos');
                            // Limpiar campos anteriores
                            campos.innerHTML = '';

                            // Agregar campos correspondientes a la tabla seleccionada
                            switch (tablaSeleccionada) {
                                case 'Proveedor':
                                    campos.innerHTML += '<p class="txagregar">Nombre:</p> <input type="text" name="nombre"><br>';
                                    campos.innerHTML += '<p class="txagregar">Dirección:</p>  <input type="text" name="direccion"><br>';
                                    campos.innerHTML += '<p class="txagregar">Teléfono:</p>  <input type="text" name="telefono"><br>';
                                    campos.innerHTML += '<p class="txagregar">Email:</p>  <input type="text" name="email"><br>';
                                    campos.innerHTML += '<input type="submit" value="Agregar">'
                                    break;
                                case 'Refaccion':
                                    campos.innerHTML += '<p class="txagregar">Nombre:</p>  <input type="text" name="nombre"><br>';
                                    campos.innerHTML += '<p class="txagregar">Descripción:</p>  <textarea name="descripcion" class="area"></textarea><br>';
                                    campos.innerHTML += '<p class="txagregar">Precio:</p>  <input type="text" name="precio"><br>';
                                    campos.innerHTML += '<p class="txagregar">Cantidad en Inventario:</p> <input type="number" name="cantidadEnInventario" value="1"><br>';
                                    campos.innerHTML += '<p class="txagregar">Proveedor ID:</p>  <input type="text" name="proveedorID"><br>';
                                    campos.innerHTML += '<p class="txagregar">Fecha de Adquisición:</p>  <input type="date" name="fechaAdquisicion"><br>';
                                    campos.innerHTML += '<input type="submit" value="Agregar">'
                                    break;
                                case 'Cliente':
                                    campos.innerHTML += '<p class="txagregar"> Nombre:</p> <input type="text" name="nombre"><br>';
                                    campos.innerHTML += '<p class="txagregar">Dirección:</p>  <input type="text" name="direccion"><br>';
                                    campos.innerHTML += '<p class="txagregar">Teléfono:</p>  <input type="text" name="telefono"><br>';
                                    campos.innerHTML += '<p class="txagregar">Email:</p>  <input type="text" name="email"><br>';
                                    campos.innerHTML += '<input type="submit" value="Agregar">'
                                    break;
                                case 'Venta':
                                    campos.innerHTML += '<p class="txagregar">Refacción:</p> <select name="refaccionID[]" id="refaccionID" class="select" onchange="actualizarPrecio()"><option value="" disabled selected hidden>Seleccione una refacción</option><?php include "obtener_refacciones.php"; ?></select><br>';
                                    campos.innerHTML += '<p class="txagregar">Cantidad:</p> <input type="number" name="cantidad[]" id="cantidad" value="1" onchange="actualizarSubtotal()"><br>';
                                    campos.innerHTML += '<p class="txagregar">Precio Unitario:</p> <input type="text" name="precioUnitario[]" id="precioUnitario" readonly><br>';
                                    campos.innerHTML += '<p class="txagregar">Subtotal:</p> <input type="text" name="subtotal[]" id="subtotal" readonly><br>';
                                    campos.innerHTML += '<p class="txagregar">ID Cliente:</p> <select name="idcliente" id="idcliente" class="select"><option value="" disabled selected hidden>Seleccione un cliente</option><?php include "obtener_clientes.php"; ?></select><br>';
                                    campos.innerHTML += '<p class="txagregar">Fecha de Venta:</p>  <input type="date" name="fechaVenta"><br>';
                                    campos.innerHTML += '<p class="txagregar">Total:</p>  <input type="text" name="total" id="total" readonly><br>';
                                    campos.innerHTML += '<input type="submit" value="Agregar">'
                                    break;
                            }
                        });

                        function actualizarPrecio() {
                            var refaccionID = document.getElementById('refaccionID').value;
                            if (refaccionID) {
                                // Hacer una llamada AJAX para obtener el precio de la refacción seleccionada
                                var xhr = new XMLHttpRequest();
                                xhr.open('GET', 'obtener_precio.php?id=' + refaccionID, true);
                                xhr.onload = function() {
                                    if (this.status == 200) {
                                        var precio = parseFloat(this.responseText);
                                        document.getElementById('precioUnitario').value = precio.toFixed(2);
                                        actualizarSubtotal();
                                    }
                                };
                                xhr.send();
                            }
                        }

                        function actualizarSubtotal() {
                            var cantidad = document.getElementById('cantidad').value;
                            var precioUnitario = document.getElementById('precioUnitario').value;
                            var subtotal = cantidad * precioUnitario;
                            document.getElementById('subtotal').value = subtotal.toFixed(2);
                            document.getElementById('total').value = subtotal.toFixed(2);
                        }
                    </script>

                    <!-- Contenedor dinámico para los campos -->
                    <div id="campos"></div>
                </form>
            </div>
        </div>
        <?php
        include 'contacto.php';
        ?>
    </div>
</body>

</html>
