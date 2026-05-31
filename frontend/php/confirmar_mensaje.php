<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    pg_query($conn,"
    INSERT INTO mensajes (emisor,destinatario,mensaje)
    VALUES ('gerente','cocina','Recibido')
    ");

    pg_query($conn,"
    DELETE FROM mensajes
    WHERE id=$id
    ");

    header("Location: ver_pedidos.php");
    exit();

?>