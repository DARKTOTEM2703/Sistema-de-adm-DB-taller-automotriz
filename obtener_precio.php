<?php
include("conn.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT precio FROM refaccion WHERE id = $id";
    $result = mysqli_query($enlace, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['precio'];
    }
}

mysqli_close($enlace);
?>
