<?php

    require 'bbdd.php';

    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {

        header("Location: acceso.php");
        exit();
    }

    $query = "SELECT * FROM productos ORDER BY id";

    $resultado = pg_query($conn, $query);

    $productos = pg_fetch_all($resultado);

?>

<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="UTF-8">
        <title>Pedido SmartBar</title>
        <link rel="stylesheet" href="../css/pedidos.css">

    </head>

    <body>

        <div class="pedido-box">

            <header>
                <a class="logout" href="logout.php">Cerrar sesión</a>
                <h1>🛵 Pedido para Llevar</h1>
                <p>
                    Usuario:
                    <?php echo $_SESSION['user']; ?>
                </p>
            </header>

            <h2>Nuevo Pedido</h2>

            <form action="procesarPedido.php" method="POST">

                <input type="hidden" name="tipo_vuelta" value="pedido_llevar.php">

                <label>Nombre:</label><br>
                <input type="text" name="nombre" required><br><br>

                <label>Teléfono:</label><br>
                <input type="text" name="telefono" required><br><br>

                <label>Dirección:</label><br>
                <input type="text" name="direccion" required><br><br>

                <h2>Productos</h2>

                <table border="1">

                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                    </tr>

                    <?php foreach ($productos as $producto) { ?>

                        <tr>

                            <td><?php echo $producto['id']; ?></td>

                            <td><?php echo $producto['nombre']; ?></td>

                            <td><?php echo $producto['categoria']; ?></td>

                            <td><?php echo $producto['precio']; ?> €</td>

                            <td>
                                <?php echo $producto['stock']; ?>

                                <?php if ($producto['stock'] <= 10) { ?>
                                    <br>
                                    <strong style="color:red;">⚠ Stock bajo</strong>
                                <?php } ?>
                            </td>

                            <td>

                                <input
                                    type="number"
                                    name="cantidad[<?php echo $producto['id']; ?>]"
                                    min="0"
                                    max="<?php echo $producto['stock']; ?>"
                                    value="0">

                            </td>

                        </tr>

                    <?php } ?>

                </table>

                <br>

                <button type="submit">
                    Realizar pedido
                </button>

            </form>

            <br><br>
            <hr>

            <h2>📩 Mensajes del gerente</h2>

            <?php
                $mensajes = pg_fetch_all(pg_query($conn, "
                SELECT * FROM mensajes
                WHERE destinatario='camarero'
                ORDER BY id DESC
                "));

                if ($mensajes) {
                    foreach ($mensajes as $m) {
                        echo "<p>";
                        echo $m['mensaje'];

                        echo ' <a href="confirmar_mensaje_camarero.php?id='.$m['id'].'">👍</a>';

                        echo ' <a href="borrar_mensaje.php?id='.$m['id'].'">❌</a>';

                        echo "</p>";
                    }
                }
            ?>

            <hr>

            <h2>📨 Escribir al gerente</h2>

            <form action="enviar_mensaje.php" method="POST">

                <input type="hidden" name="emisor" value="camarero">
                <input type="hidden" name="destinatario" value="gerente">

                <textarea name="mensaje" required></textarea>
                <br><br>

                <button type="submit">
                    Enviar al gerente
                </button>

            </form>
            
            <a href="logout.php">
                Cerrar sesión
            </a>

        </div>
    </body>
</html>