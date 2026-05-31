<?php

    session_start();
    require 'bbdd.php';
    require 'telegram.php';

    if (!isset($_SESSION['user'])) {
        header("Location: acceso.php");
        exit();
    }

    $mensaje = $_POST['mensaje'];

    enviarTelegram("🚨 SmartBar\n\nMensaje de cocina:\n" . $mensaje);

    $emisor = 'cocina';
    $destinatario = 'gerente';

    $query = "
    INSERT INTO mensajes (emisor, destinatario, mensaje)
    VALUES ($1, $2, $3)
    ";

    pg_query_params(
        $conn,
        $query,
        array($emisor, $destinatario, $mensaje)
    );

    header("Location: cocina.php");
    exit();

?>