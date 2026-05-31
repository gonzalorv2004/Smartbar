<?php

    session_start();

    require 'bbdd.php';

    if (!isset($_SESSION['user'])) {

        header("Location: cocina.php");
        exit();
    }

    $query = "
    SELECT
        p.id AS pedido_id,
        u.nombre AS usuario,
        p.nombre_cliente,
        p.telefono,
        p.direccion,
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
        <link rel="stylesheet" href="../css/admin.css">

    </head>

    <body>

        <header>
            <a class="logout" href="logout.php">Cerrar sesión</a>
            <h1>🛠️ Administración SmartBar</h1>
            <p>Control global de pedidos</p>
            <p>
                Usuario:
                <?php echo $_SESSION['user']; ?>
            </p>
        </header>

        <table>

            <tr>

                <th>Pedido</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Dirección</th>
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
                            <?php echo $pedido['nombre_cliente']; ?>
                        </td>

                        <td>
                            <?php echo $pedido['telefono']; ?>
                        </td>

                        <td>
                            <?php echo $pedido['direccion']; ?>
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

        <br><br>

        <a href="logout.php">
            Cerrar sesión
        </a>

    </body>

    <hr>

    <h2>Mensajes de cocina</h2>

    <?php
    $mensajes = pg_fetch_all(pg_query($conn, "
    SELECT * FROM mensajes
    WHERE destinatario='gerente'
    AND (emisor='cocina' OR emisor='conserje')
    ORDER BY id DESC
    "));

    if ($mensajes) {
        foreach ($mensajes as $m) {
            echo "<p>";
            echo "<strong>[" . $m['emisor'] . "]</strong> " . $m['mensaje'];
            echo ' <a href="borrar_mensaje.php?id='.$m['id'].'">❌</a>';
            echo "</p>";
        }
    }
    ?>

    <h2>Responder a cocina</h2>

    <form action="enviar_mensaje.php" method="POST">

        <input type="hidden" name="emisor" value="gerente">
        <input type="hidden" name="destinatario" value="cocina">

        <textarea name="mensaje" required></textarea>
        <br><br>

        <button type="submit">
            Enviar respuesta
        </button>

    </form>

</html>