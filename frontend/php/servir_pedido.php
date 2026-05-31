<?php

session_start();

require 'bbdd.php';

if (!isset($_SESSION['user'])) {

    header("Location: acceso.php");
    exit();
}

$id = $_GET['id'];

$query = "
UPDATE pedidos
SET estado = 'servido'
WHERE id = $1
";

pg_query_params(
    $conn,
    $query,
    array($id)
);

header("Location: cocina.php");

?>