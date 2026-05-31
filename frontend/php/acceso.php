<?php
    session_start();

    if (!isset($_SESSION['intentos'])) {
        $_SESSION['intentos'] = 0;
    }

    $error = "";

    if (isset($_GET['error'])) {
        $error = "Usuario y/o contraseña incorrecta, por favor inténtelo de nuevo.";
    }
?>

<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="UTF-8">
        <title>Login SmartBar</title>
        <link rel="stylesheet" href="../css/login.css">

    </head>

    <body style="font-family: Arial; text-align:center; margin-top:100px;">

        <div class="login-box">

            <h1>🍺 SmartBar Login 🚀</h1>

            <form action="login.php" method="POST">

                <input type="text" name="username" placeholder="Usuario" required>

                <input type="password" name="pass" placeholder="Contraseña" required>

                <button type="submit">Iniciar sesión</button>

            </form>

            <br>

            <p>
                ¿Deseas solicitar empleo?
                <a href="../solicitud_empleo.php">Haz clic aquí</a>
            </p>

            <?php if ($error != "") { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

        </div>

    </body>

</html>