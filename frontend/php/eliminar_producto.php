<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    $query = "
    DELETE FROM productos
    WHERE id = $1
    ";

    pg_query_params($conn, $query, array($id));

    header("Location: ver_pedidos.php");
    exit();

?>