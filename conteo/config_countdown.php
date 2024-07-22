<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $active = isset($_POST['active']) ? 1 : 0;
    $end_date = $_POST['end_date'];

    $query = "UPDATE countdown_config SET active = $active, end_date = '$end_date' WHERE id = 1";

    if (mysqli_query($conn, $query)) {
        echo "Configuración actualizada exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Obtener la configuración actual
$query = "SELECT * FROM countdown_config WHERE id = 1";
$result = mysqli_query($conn, $query);
$config = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurar Cuenta Regresiva - Juegos UCSI 2024</title>
    <link rel="stylesheet" href="../assets/css/forms.css">
</head>
<body>
    <h1>Configurar Cuenta Regresiva</h1>
    <form action="config_countdown.php" method="post">
        <label for="active">Activar Cuenta Regresiva:</label>
        <input type="checkbox" id="active" name="active" <?php if ($config['active']) echo 'checked'; ?>>
        
        <label for="end_date">Fecha de Finalización:</label>
        <input type="datetime-local" id="end_date" name="end_date" value="<?php echo date('Y-m-d\TH:i', strtotime($config['end_date'])); ?>" required>
        
        <button type="submit">Guardar Configuración</button>
    </form>
    <a href="../index.php" class="btn">Volver a la Página Principal</a>
</body>
</html>
