<?php

    require 'bbdd.php';

    $id = $_POST['id'];
    $rol = $_POST['rol'];
    $turno = $_POST['turno'];

    $query = "
    UPDATE usuarios
    SET rol=$1, turno=$2
    WHERE id=$3
    ";

    pg_query_params(
        $conn,
        $query,
        array(
            $rol,
            $turno,
            $id
        )
    );

    header("Location: gerente.php");
    exit();

?>