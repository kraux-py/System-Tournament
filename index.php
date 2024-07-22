<?php
include('php/db_connection.php');

// Verificar si hay un conteo activo en la tabla countdown_config
$query = "SELECT * FROM countdown_config WHERE end_date > NOW() LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Redirigir a conteo/conteo.php si hay un conteo activo
    header("Location: conteo/conteo.php");
} else {
    // Redirigir a index.html si no hay un conteo activo
    header("Location: index.html");
}
exit();
?>
