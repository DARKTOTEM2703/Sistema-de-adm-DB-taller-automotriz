
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Control - Refaccionaria</title>
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
                <h2>Bienvenido al Taller Autoyuc</h2>
                <img class="imginicio" src="imagenes/imageninicio.jpg" alt="">
                <h3 class="slogan">"En cada motor, dejamos nuestra pasión."</h2>
            </div>
        </div>
        <?php
        include 'contacto.php';
        ?>
    </div>
</body>

</html>