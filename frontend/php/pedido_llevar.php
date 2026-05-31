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
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                    </tr>

                    <?php foreach ($productos as $producto) { ?>

                        <tr>

                            <td><?php echo $producto['id']; ?></td>

                            <td><?php echo $producto['nombre']; ?></td>

                            <td><?php echo $producto['precio']; ?> €</td>

                            <td><?php echo $producto['stock']; ?></td>

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

            <a href="logout.php">
                Cerrar sesión
            </a>

        </div>
    </body>
</html>