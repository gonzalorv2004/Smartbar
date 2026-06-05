<?php

    require 'bbdd.php';

    $emisor = $_POST['emisor'];
    $destinatario = $_POST['destinatario'];
    $mensaje = $_POST['mensaje'];

    $query = "
    INSERT INTO mensajes (emisor, destinatario, mensaje)
    VALUES ($1, $2, $3)
    ";

    pg_query_params(
        $conn,
        $query,
        array($emisor, $destinatario, $mensaje)
    );

    if ($emisor == 'gerente') {
    header("Location: gerente.php");
    }
    elseif ($emisor == 'camarero') {

        $tipo_vuelta = $_POST['tipo_vuelta'] ?? 'pedido_llevar.php';

        if ($tipo_vuelta == 'pedido_tomar.php') {
            header("Location: pedido_tomar.php");
        } else {
            header("Location: pedido_llevar.php");
        }

    }
    else {
        header("Location: cocina.php");
    }

    exit();

?>