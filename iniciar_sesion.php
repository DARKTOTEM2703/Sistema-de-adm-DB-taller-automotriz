<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - Refaccionaria</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'head.php';
    ?>
    <div class="background ancho">
        <div class="contlog">
            <h2>Inicio de Sesion</h2>
            <form action="procesar_login.php" method="post" class="formlogin">
                <input type="text" id="nombreUsuario" name="nombreUsuario" required placeholder="Usuario"><br>
                <input type="password" id="contraseña" name="contraseña" required placeholder="Contraseña"><br>
                <input type="submit" value="Iniciar sesión">
            </form>
        </div>
        <?php
        include 'contacto.php';
        ?>
    </div>
</body>
</html>
