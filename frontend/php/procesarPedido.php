<?php

    session_start();

    require 'bbdd.php';

    if (!isset($_SESSION['user'])) {

        header("Location: acceso.php");
        exit();
    }

    $cantidades = $_POST['cantidad'] ?? [];

    $hayProductos = false;

    foreach ($cantidades as $cantidad) {

        if ($cantidad > 0) {

            $hayProductos = true;
            break;
        }
    }

    if (!$hayProductos) {

        die("No se seleccionaron productos");
    }

    $user = $_SESSION['user'];

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipo_pedido = ($_POST['tipo_vuelta'] == 'pedido_tomar.php')
    ? 'tomar'
    : 'llevar';

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
    INSERT INTO pedidos (
    id_usuario,
    nombre_cliente,
    telefono,
    direccion,
    estado,
    tipo_pedido
    )
    VALUES ($1, $2, $3, $4, 'pendiente', $5)
    RETURNING id
    ";

    $resultPedido = pg_query_params(
        $conn,
        $queryPedido,
        array(
            $id_usuario,
            $nombre,
            $telefono,
            $direccion,
            $tipo_pedido
        )
    );

    $pedido = pg_fetch_assoc($resultPedido);

    $id_pedido = $pedido['id'];

    foreach ($cantidades as $id_producto => $cantidad) {

        if ($cantidad > 0) {

            $queryDetalle = "
            INSERT INTO detalle_pedido (
                id_pedido,
                id_producto,
                cantidad
            )
            VALUES ($1, $2, $3)
            ";

            pg_query_params(
                $conn,
                $queryDetalle,
                array(
                    $id_pedido,
                    $id_producto,
                    $cantidad
                )
            );

            $queryStock = "
            UPDATE productos
            SET stock = stock - $1
            WHERE id = $2
            ";

            pg_query_params(
                $conn,
                $queryStock,
                array(
                    $cantidad,
                    $id_producto
                )
            );
        }
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

        <?php var_dump($_POST['tipo_vuelta']); ?>
        <br><br>
        <a href="<?php echo $_POST['tipo_vuelta']; ?>">Volver a pedidos</a>

    </body>

</html>