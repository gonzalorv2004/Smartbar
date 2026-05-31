<?php

    require 'bbdd.php';

    $id = $_GET['id'];
    $estado = $_GET['estado'];

    $query = "UPDATE pedidos SET estado = $1 WHERE id = $2";

    pg_query_params($conn, $query, array($estado, $id));

    header("Location: cocina.php");
    exit();

?>