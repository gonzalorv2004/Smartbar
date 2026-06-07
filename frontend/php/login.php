<?php

    session_start();

    require 'bbdd.php';

    if (!isset($_SESSION['intentos'])) {
        $_SESSION['intentos'] = 0;
    }

    $userf = $_POST['username'] ?? '';
    $passf = $_POST['pass'] ?? '';

    $query = "SELECT * FROM usuarios WHERE nombre = $1";

    $resultado = pg_query_params(
        $conn,
        $query,
        array($userf)
    );

    if (pg_num_rows($resultado) == 1) {

        if ($passf == $usuario['password']) {

            $_SESSION['user'] = $usuario['nombre'];

            $_SESSION['intentos'] = 0;

            if ($usuario['rol'] == 'admin') {

                header("Location: ver_pedidos.php");
                exit();

            } elseif ($usuario['rol'] == 'gerente') {

                header("Location: gerente.php");
                exit();

            } elseif ($usuario['rol'] == 'cocina' || $usuario['rol'] == 'cocinero') {

                header("Location: cocina.php");
                exit();

            } elseif ($usuario['rol'] == 'camarero') {

                header("Location: ../seleccion_pedido.php");
                exit();

            } elseif ($usuario['rol'] == 'conserje') {

                header("Location: ../conserje.html");
                exit();

            } else {

                header("Location: acceso.php");
                exit();
            }

        } else {

            $_SESSION['intentos']++;

            if ($_SESSION['intentos'] >= 3) {

                header("Location: acceso_denegado.html");
                exit();

            } else {

                $_SESSION['error_login'] = true;

                header("Location: acceso.php?error=1");
                exit();
            }
        }

    } else {

        $_SESSION['intentos']++;

        if ($_SESSION['intentos'] >= 3) {

            header("Location: ../acceso_denegado.html");
            exit();

        } else {

            $_SESSION['error_login'] = true;

            header("Location: acceso.php?error=1");
            exit();
        }

    }

?>