
<?php
// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

// Dependiendo del tipo de usuario, mostrar diferentes botones
$rol = $_SESSION['rol'];
?>