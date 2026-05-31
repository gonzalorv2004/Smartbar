<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    pg_query_params(
        $conn,
        "DELETE FROM mensajes WHERE id = $1",
        array($id)
    );

    header("Location: cocina.php");
    exit();

?>