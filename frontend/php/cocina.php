<?php

    session_start();
    require 'bbdd.php';

    if (!isset($_SESSION['user'])) {
        header("Location: acceso.php");
        exit();
    }

    $query_llevar = "
    SELECT *
    FROM pedidos
    WHERE tipo_pedido = 'llevar'
    ORDER BY id DESC
    ";

    $query_tomar = "
    SELECT *
    FROM pedidos
    WHERE tipo_pedido = 'tomar'
    ORDER BY id DESC
    ";

    $llevar = pg_fetch_all(pg_query($conn, $query_llevar));
    $tomar = pg_fetch_all(pg_query($conn, $query_tomar));

    function siguienteEstado($estado) {
        if ($estado == 'pendiente') return 'en_preparacion';
        if ($estado == 'en_preparacion') return 'servido';
        if ($estado == 'servido') return 'finalizado';
        return '';
    }

    function textoBoton($estado) {
        if ($estado == 'pendiente') return 'En preparación';
        if ($estado == 'en_preparacion') return 'Servido';
        if ($estado == 'servido') return 'Finalizado';
        return '✔ Finalizado';
    }

    function pintarTabla($pedidos) {
        if ($pedidos) {
            foreach ($pedidos as $pedido) {
                echo "<tr>";
                echo "<td>".$pedido['id']."</td>";

                if ($pedido['tipo_pedido'] == 'tomar') {
                    echo "<td>Mesa Nº ".$pedido['mesa']."</td>";
                } else {
                    echo "<td>".$pedido['nombre_cliente']."</td>";
                }
                
                echo "<td>".$pedido['estado']."</td>";
                echo "<td>";

                if ($pedido['estado'] != 'finalizado') {
                    echo '<a href="actualizar_estado.php?id='.$pedido['id'].'&estado='.siguienteEstado($pedido['estado']).'">
                            <button>'.textoBoton($pedido['estado']).'</button>
                        </a>';
                } else {
                    echo "✔ Finalizado";
                }

                echo "</td>";
                echo "</tr>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8">
        <title>Cocina SmartBar</title>
        <link rel="stylesheet" href="../css/cocina.css">

    </head>

    <body style="font-family: Arial;">

        <header>
            <a class="logout" href="logout.php">Cerrar sesión</a>
            <h1>👨‍🍳 Cocina SmartBar</h1>
            <p>Usuario: <?php echo $_SESSION['user']; ?></p>
            <p>Gestión y seguimiento de pedidos</p>
        </header>

        <h2>Pedidos para llevar</h2>

        <table border="1" cellpadding="10">
        <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Acción</th>
        </tr>
        <?php pintarTabla($llevar); ?>
        </table>

        <br><br>

        <h2>Pedidos para tomar</h2>

        <table border="1" cellpadding="10">
        <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Acción</th>
        </tr>
        <?php pintarTabla($tomar); ?>
        </table>

        <br><br>

        <a href="logout.php">Cerrar sesión</a>

    </body>
    
    <hr>

    <h2>Mensajes al gerente</h2>

    <form action="enviar_mensaje.php" method="POST">
        <input type="hidden" name="emisor" value="cocina">
        <input type="hidden" name="destinatario" value="gerente">

        <textarea name="mensaje" required></textarea><br><br>

        <button type="submit">Enviar mensaje</button>
    </form>

    <h3>Mensajes recibidos</h3>

    <?php
    $mensajes = pg_fetch_all(pg_query($conn, "
    SELECT * FROM mensajes
    WHERE destinatario='cocina'
    ORDER BY id DESC
    "));

    if ($mensajes) {
        foreach ($mensajes as $m) {
            echo "<p>";
            echo $m['mensaje'];
            echo ' <a href="borrar_mensaje.php?id='.$m['id'].'">❌</a>';
            echo "</p>";
        }
    }
    ?>

</html>