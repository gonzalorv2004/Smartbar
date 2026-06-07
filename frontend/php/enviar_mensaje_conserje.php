<?php

    session_start();

    require 'bbdd.php';
    require 'telegram.php';

    if (!isset($_SESSION['user'])) {
        header("Location: acceso.php");
        exit();
    }

    $mensaje = $_POST['mensaje'];

    $usuario = $_SESSION['user'];
    $hora = date('d/m/Y H:i:s');
    $destinatario = "Gerente";

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
        array(
            'conserje',
            'gerente',
            $mensaje
        )
    );

    header("Location: ../conserje.php");
    exit();

?>