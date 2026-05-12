<?php

session_start();

require 'bbdd.php';

if (!isset($_SESSION['user'])) {

    header("Location: acceso.php");
    exit();
}

$query = "
SELECT
    p.id AS pedido_id,
    u.nombre AS usuario,
    pr.nombre AS producto,
    dp.cantidad,
    pr.precio,
    p.estado,
    p.fecha

FROM pedidos p

JOIN usuarios u
    ON p.id_usuario = u.id

JOIN detalle_pedido dp
    ON p.id = dp.id_pedido

JOIN productos pr
    ON dp.id_producto = pr.id

ORDER BY p.id DESC
";

$resultado = pg_query($conn, $query);

$pedidos = pg_fetch_all($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Pedidos</title>
</head>

<body>

    <h1>Pedidos SmartBar</h1>

    <p>
        Usuario:
        <?php echo $_SESSION['user']; ?>
    </p>

    <table border="1">

        <tr>

            <th>Pedido</th>
            <th>Usuario</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Fecha</th>

        </tr>

        <?php if ($pedidos) { ?>

            <?php foreach ($pedidos as $pedido) { ?>

                <tr>

                    <td>
                        <?php echo $pedido['pedido_id']; ?>
                    </td>

                    <td>
                        <?php echo $pedido['usuario']; ?>
                    </td>

                    <td>
                        <?php echo $pedido['producto']; ?>
                    </td>

                    <td>
                        <?php echo $pedido['cantidad']; ?>
                    </td>

                    <td>
                        <?php echo $pedido['precio']; ?> €
                    </td>

                    <td>
                        <?php echo $pedido['estado']; ?>
                    </td>

                    <td>
                        <?php echo $pedido['fecha']; ?>
                    </td>

                </tr>

            <?php } ?>

        <?php } ?>

    </table>

    <br>

    <a href="pedido.php">
        Volver
    </a>

    <br><br>

    <a href="logout.php">
        Cerrar sesión
    </a>

</body>
</html>