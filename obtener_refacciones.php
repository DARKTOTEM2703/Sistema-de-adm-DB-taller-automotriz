<?php
include("conn.php");

$query = "SELECT id, nombre FROM refaccion";
$result = mysqli_query($enlace, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
    }
}

mysqli_close($enlace);
?>
