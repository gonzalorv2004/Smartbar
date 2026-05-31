<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    $mensaje = pg_fetch_assoc(
        pg_query_params(
            $conn,
            "SELECT * FROM mensajes WHERE id=$1",
            array($id)
        )
    );

    $destino = $mensaje['emisor'];

    pg_query_params(
        $conn,
        "
        INSERT INTO mensajes (emisor, destinatario, mensaje)
        VALUES ($1,$2,$3)
        ",
        array(
            'gerente',
            $destino,
            'Recibido'
        )
    );

    pg_query_params(
        $conn,
        "DELETE FROM mensajes WHERE id=$1",
        array($id)
    );

    header("Location: gerente.php");
    exit();

?>