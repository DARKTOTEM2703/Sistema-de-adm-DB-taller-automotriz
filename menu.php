<meta charset="UTF-8">
<title>Panel de Control - Refaccionaria</title>

<div class="menu">
    <?php if ($rol === 'Administrador') : ?>
        <!-- Mostrar botones para el Administrador -->
        <a class="opcion primeropcion" href="index.php">Inicio</a>
        <div class="opcion desplegable primero">
            <a >Consultar Tablas</a>
            <div class="ContenidoDesplegable">
                <a class="opcion" href="consultar.php">Consultar Proveedores</a>
                <a class="opcion" href="consultar_refacciones.php">Consultar Refacciones</a>
                <a class="opcion" href="consultar_existencias.php">Consultar Existencias</a>
            </div>
        </div> 
        <div class="opcion desplegable">
            <a >Administrar</a>
            <div class="ContenidoDesplegable">
            <a class="opcion" href="editar.php">Editar Proveedores</a>
            <a class="opcion" href="agregar.php">Agregar Datos</a>
            <a class="opcion" href="eliminar.php">Eliminar Datos</a>
            </div>
        </div>   
        <a class="opcion" href="estado_pedidos.php">Estado de Pedidos</a>
    <?php elseif ($rol === 'Agente de ventas') : ?>
        <!-- Mostrar botones para el Agente de ventas -->
        <a class="opcion primeropcion" href="index.php">Inicio</a>
        <a class="opcion" href="agregar.php">Agregar Ventas</a>
        <div class="opcion desplegable primero">
            <a >Consultar Tablas</a>
            <div class="ContenidoDesplegable">
                <a class="opcion" href="consultar_refacciones.php">Consultar Refacciones</a>
                <a class="opcion" href="consultar_existencias.php">Consultar Existencias</a>
            </div>
        </div> 
        <a class="opcion" href="estado_pedidos.php">Estado de Pedidos</a>
    <?php elseif ($rol === 'Cliente') : ?>
        <!-- Mostrar botones para el Cliente -->
        <a class="opcion primeropcion" href="index.php">Inicio</a>
        <a class="opcion" href="consultar_refacciones.php">Consultar Refacciones</a>
        <a class="opcion" href="estado_pedidos.php">Estado de Pedidos</a>
        <!-- Agregar más enlaces según las funciones del Cliente -->
    <?php endif; ?>
    <a class="salir" href="cerrar_sesion.php">Cerrar Sesión</a>
</div>