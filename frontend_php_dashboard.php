<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: acceso.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard SmartBar</title>
    </head>
    <body>
        <h1>Bienvenido a SmartBar</h1>
        <p>Usuario conectado:
            <?php echo $_SESSION['usuario']; ?>
        </p>
        <a href="logout.php">Cerrar sesión</a>
    </body>
</html>
