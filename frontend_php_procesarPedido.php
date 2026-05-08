<?php

session_start();

require 'bbdd.php';

if (!isset($_SESSION['user'])) {

    header("Location: acceso.php");
    exit();
}

$productos = $_POST['productos'] ?? [];

if (count($productos) == 0) {

    die("No se seleccionaron productos");
}

$user = $_SESSION['user'];

$queryUser = "
SELECT id 
FROM usuarios 
WHERE nombre = $1
";

$resultUser = pg_query_params(
    $conn,
    $queryUser,
    array($user)
);

$usuario = pg_fetch_assoc($resultUser);

$id_usuario = $usuario['id'];

$queryPedido = "
INSERT INTO pedidos
(id_usuario, estado)
VALUES ($1, 'pendiente')
RETURNING id
";

$resultPedido = pg_query_params(
    $conn,
    $queryPedido,
    array($id_usuario)
);

$pedido = pg_fetch_assoc($resultPedido);

$id_pedido = $pedido['id'];

foreach ($productos as $id_producto) {

    $queryDetalle = "
    INSERT INTO detalle_pedido
    (id_pedido, id_producto, cantidad)
    VALUES ($1, $2, 1)
    ";

    pg_query_params(
        $conn,
        $queryDetalle,
        array(
            $id_pedido,
            $id_producto
        )
    );

    $queryStock = "
    UPDATE productos
    SET stock = stock - 1
    WHERE id = $1
    ";

    pg_query_params(
        $conn,
        $queryStock,
        array($id_producto)
    );
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedido realizado</title>
</head>

<body>

    <h1>Pedido realizado correctamente</h1>

    <a href="pedido.php">
        Volver a pedidos
    </a>

</body>
</html>
