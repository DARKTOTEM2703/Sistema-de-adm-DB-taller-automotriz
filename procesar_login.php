<?php
include("conn.php");

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se proporcionaron el nombre de usuario y la contraseña
    if (isset($_POST['nombreUsuario']) && isset($_POST['contraseña'])) {
        // Obtener los datos del formulario
        $nombreUsuario = $_POST['nombreUsuario'];
        $contraseña = $_POST['contraseña'];

        // Consulta SQL para verificar las credenciales en la base de datos
        $consulta = "SELECT * FROM Usuario WHERE nombreUsuario = '$nombreUsuario'";
        $resultado = mysqli_query($enlace, $consulta);

        // Verificar si se encontró algún resultado
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Obtener el registro de usuario
            $usuario = mysqli_fetch_assoc($resultado);
            
            // Verificar la contraseña
            if ($usuario['contraseña'] === $contraseña) {
                // Las credenciales son válidas, redirigir al usuario a la página de inicio
                session_start();
                $_SESSION['usuarioID'] = $usuario['usuarioID'];
                $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
                $_SESSION['rol'] = $usuario['rol'];
                header("Location: index.php"); // Cambia 'index.php' por la página a la que deseas redirigir después del inicio de sesión
                exit();
            } else {
                // Las credenciales son inválidas, mostrar un mensaje de error
                echo
                "<script>
                    alert('Error: Nombre de usuario o contraseña incorrectos.');
                    window.location.href='iniciar_sesion.php';
                </script>";
            }
        } else {
            // Las credenciales son inválidas, mostrar un mensaje de error
            echo
            "<script>
                alert('Error: Nombre de usuario o contraseña incorrectos.');
                window.location.href='iniciar_sesion.php';
            </script>";
        }
    } else {
        // Los datos de inicio de sesión no se proporcionaron correctamente
        echo
        "<script>
            alert('Error: Por favor, ingrese su nombre de usuario y contraseña.');
            window.location.href='iniciar_sesion.php';
        </script>";
    }
}

mysqli_close($enlace);
?>
