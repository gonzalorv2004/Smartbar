<?php

    require 'bbdd.php';

    $query = "
    UPDATE productos
    SET nombre = $1,
        categoria = $2,
        precio = $3,
        stock = $4
    WHERE id = $5
    ";

    pg_query_params($conn, $query, array(
        $_POST['nombre'],
        $_POST['categoria'],
        $_POST['precio'],
        $_POST['stock'],
        $_POST['id']
    ));

    header("Location: ver_pedidos.php");
    exit();

?>