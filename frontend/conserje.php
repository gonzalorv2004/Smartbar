<?php

    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: php/acceso.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="UTF-8">
        <title>Panel Conserje</title>
        <link rel="stylesheet" href="css/conserje.css">

    </head>

    <body style="font-family: Arial; margin:40px;">

        <div class="conserje-box">

            <header>
                <a class="logout" href="php/logout.php">Cerrar sesión</a>
                <h1>🧹 Panel de Conserjería SmartBar</h1>
                <p>
                    Usuario: <?php echo $_SESSION['user']; ?>
                </p>
            </header>

            <form action="php/enviar_mensaje_conserje.php" method="POST">

                <h2>Enviar aviso al gerente</h2>

                <textarea name="mensaje" placeholder="Escribe aquí la incidencia..." required></textarea>

                <br>

                <button type="submit">Enviar mensaje</button>

            </form>

        </div>

    </body>

</html>