<?php

    session_start();

    require 'bbdd.php';
    require 'telegram.php';

    $emisor = $_POST['emisor'];
    $destinatario = $_POST['destinatario'];
    $mensaje = $_POST['mensaje'];

    $usuario = $_SESSION['user'];
    $rol = $_SESSION['rol'];

    $hora = date('d/m/Y H:i:s');

    $textoTelegram =
    "🚨 SmartBar\n\n" .
    "📨 Nuevo mensaje interno\n\n" .
    "👤 Usuario: $usuario\n" .
    "📬 Destinatario: $destinatario\n" .
    "🕒 Hora: $hora\n\n" .
    "💬 Mensaje:\n$mensaje";

    enviarTelegram($textoTelegram);

    $query = "
    INSERT INTO mensajes (emisor, destinatario, mensaje)
    VALUES ($1, $2, $3)
    ";

    pg_query_params(
        $conn,
        $query,
        array($emisor, $destinatario, $mensaje)
    );

    if ($rol == 'admin') {

        header("Location: ver_pedidos.php");

    } elseif ($rol == 'gerente') {

        header("Location: gerente.php");

    } elseif ($rol == 'cocina' || $rol == 'cocinero') {

        header("Location: cocina.php");

    } elseif ($rol == 'camarero') {

        $tipo_vuelta = $_POST['tipo_vuelta'] ?? 'pedido_llevar.php';

        if ($tipo_vuelta == 'pedido_tomar.php') {
            header("Location: pedido_tomar.php");
        } else {
            header("Location: pedido_llevar.php");
        }

    } elseif ($rol == 'conserje') {

        header("Location: ../conserje.php");

    } else {

        header("Location: acceso.php");

    }

    exit();

?>