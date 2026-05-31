<?php

    session_start();
    require 'bbdd.php';
    require 'telegram.php';

    if (!isset($_SESSION['user'])) {
        header("Location: acceso.php");
        exit();
    }

    $mensaje = $_POST['mensaje'];

    enviarTelegram("🚨 SmartBar\n\nMensaje de conserjería:\n" . $mensaje);

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

    header("Location: ../conserje.html");
    exit();

?>