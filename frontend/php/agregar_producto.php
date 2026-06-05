<?php

    require 'bbdd.php';

    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $query = "
    INSERT INTO productos (nombre, categoria, precio, stock)
    VALUES ($1, $2, $3, $4)
    ";

    pg_query_params($conn, $query, array(
        $nombre,
        $categoria,
        $precio,
        $stock
    ));

    header("Location: ver_pedidos.php");
    exit();

?>