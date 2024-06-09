<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Datos - Refaccionaria</title>
</head>
<?php include 'rol.php'; ?>

<body>
    <?php include 'head.php'; ?>
    <div class="background ancho">
        <div class="contenedor-principal">
            <?php include 'menu.php'; ?>
            <div class="contenido">
                <h2>Eliminar Datos</h2>
                <form action="eliminar_datos.php" method="POST">
                    <label for="tabla">Seleccione la tabla:</label>
                    <select name="tabla" id="tabla" class="select">
                        <option value="" disabled selected hidden>Seleccione una tabla</option>
                        <option value="Proveedor">Proveedor</option>
                        <option value="Refaccion">Refaccion</option>
                        <option value="Cliente">Cliente</option>
                        <!-- Agrega más opciones según las tablas disponibles en tu base de datos -->
                    </select>
                </form>

                <div id="table-container"></div> <!-- Contenedor para la tabla -->
            </div>
        </div>
        <?php include 'contacto.php'; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.getElementById('tabla');
            selectElement.addEventListener('change', function() {
                var tablaSeleccionada = this.value;

                // Limpiar el contenedor de la tabla antes de agregar una nueva
                var tableContainer = document.getElementById('table-container');
                tableContainer.innerHTML = '';

                // Obtener los datos de la tabla seleccionada y mostrarlos
                fetch('obtener_tabla.php?tabla=' + tablaSeleccionada)
                    .then(response => response.json())
                    .then(datosTabla => {
                        if (datosTabla.error) {
                            tableContainer.innerText = 'Error: ' + datosTabla.error;
                        } else {
                            mostrarTabla(datosTabla, tablaSeleccionada);
                        }
                    })
                    .catch(error => {
                        tableContainer.innerText = 'Error al obtener los datos de la tabla: ' + error;
                    });
            });
        });

        function mostrarTabla(datos, tablaSeleccionada) {
            var tableContainer = document.getElementById('table-container');
            tableContainer.innerHTML = ''; // Limpiar contenido previo

            if (datos.length === 0) {
                tableContainer.innerText = 'No hay datos disponibles para la tabla seleccionada.';
                return;
            }

            // Mapeo de nombres de columnas a textos deseados
            var columnMap = {
                'ProveedorID': 'id',
                'nombre': 'Nombre',
                'direccion': 'Direccion',
                'telefono': 'Correo Electrónico',
                'email': 'Email',

                'RefaccionID': 'id',
                'descripcion': 'Descripcion',
                'precio': 'Precio',
                'cantidadEnInventario': 'Cantidad en Inventario',
                'fechaAdquisicion': 'Fecha de Adquisición',

                'ClienteID': 'id',
            };

            var table = document.createElement('table');
            var thead = document.createElement('thead');
            var tbody = document.createElement('tbody');

            // Crear encabezado de la tabla
            var headerRow = document.createElement('tr');
            for (var key in datos[0]) {
                var th = document.createElement('th');
                th.innerText = columnMap[key] || key; // Usa el mapeo o el nombre original si no hay mapeo
                headerRow.appendChild(th);
            }
            // Agregar una columna para los botones de eliminación
            var th = document.createElement('th');
            th.innerText = 'Acción';
            headerRow.appendChild(th);
            thead.appendChild(headerRow);

            // Definir idAttribute según la tabla seleccionada
            var idAttribute = columnMap[tablaSeleccionada + 'ID'];

            // Crear cuerpo de la tabla
            datos.forEach(row => {
                var tr = document.createElement('tr');
                var first = true;
                for (var key in row) {
                    var td = document.createElement('td');
                    td.innerText = row[key];
                    if (first) {
                        td.classList.add('amarillo'); // Agregar clase "amarillo" a la primera columna
                        first = false;
                    }
                    tr.appendChild(td);
                }

                // Agregar botón de eliminación
                var td = document.createElement('td');
                var button = document.createElement('button');
                button.innerText = 'Eliminar';
                button.classList.add('btneliminar'); // Agregar clase "btneliminar" al botón
                button.addEventListener('click', function() {
                    eliminarElemento(row['id'], tablaSeleccionada, idAttribute);
                });
                td.appendChild(button);
                tr.appendChild(td);

                tbody.appendChild(tr);
            });

            table.appendChild(thead);
            table.appendChild(tbody);
            tableContainer.appendChild(table);
        }

        function eliminarElemento(id, tabla, idAttribute) {
            if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
                // Realizar la solicitud para eliminar el elemento
                fetch('eliminar_elemento.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id,
                            tabla: tabla,
                            idAttribute: idAttribute
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Elemento eliminado con éxito');
                            // Recargar los datos de la tabla
                            document.getElementById('tabla').dispatchEvent(new Event('change'));
                        } else {
                            alert('Error al eliminar el elemento: ' + data.error);
                        }
                    })
                    .catch(error => {
                        alert('Error al realizar la solicitud: ' + error);
                    });
            }
        }
    </script>
</body>

</html>