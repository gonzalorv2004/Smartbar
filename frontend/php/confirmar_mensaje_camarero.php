<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    pg_query_params(
        $conn,
        "
        INSERT INTO mensajes (emisor,destinatario,mensaje)
        VALUES ($1,$2,$3)
        ",
        array(
            'sistema',
            'gerente',
            'Recibido por camarero'
        )
    );

    pg_query_params(
        $conn,
        "DELETE FROM mensajes WHERE id=$1",
        array($id)
    );

    header("Location: pedido_llevar.php");
    exit();

?>