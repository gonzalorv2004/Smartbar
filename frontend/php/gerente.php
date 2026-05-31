<?php

    session_start();
    require 'bbdd.php';

    if (!isset($_SESSION['user'])) {
        header("Location: acceso.php");
        exit();
    }

    $usuarios = pg_fetch_all(pg_query($conn, "SELECT * FROM usuarios ORDER BY id"));

    $pedidosTomar = pg_fetch_all(pg_query($conn,"
    SELECT *
    FROM pedidos
    WHERE tipo_pedido='tomar'
    ORDER BY id DESC
    "));

    $pedidosLlevar = pg_fetch_all(pg_query($conn,"
    SELECT *
    FROM pedidos
    WHERE tipo_pedido='llevar'
    ORDER BY id DESC
    "));

    $mensajes = pg_fetch_all(pg_query($conn,"
    SELECT *
    FROM mensajes
    WHERE destinatario='gerente'
    ORDER BY id DESC
    "));

    $solicitudes = pg_fetch_all(pg_query($conn,"
    SELECT *
    FROM solicitudes_empleo
    ORDER BY id DESC
    "));

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Panel Gerente SmartBar</title>
        <link rel="stylesheet" href="../css/gerente.css">
    </head>

    <body style="font-family:Arial; margin:30px;">

        <header>
            <a class="logout" href="logout.php">Cerrar sesión</a>
            <h1>👔 Panel de Gerencia SmartBar</h1>
            <p>Centro de control del sistema</p>
        </header>

        <h2>👥 Gestión de Usuarios</h2>

        <table border="1" cellpadding="10">
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Rol</th>
        <th>Turno</th>
        </tr>

        <?php if($usuarios){ foreach($usuarios as $u){ ?>
        <tr>
        <td><?php echo $u['id']; ?></td>
        <td><?php echo $u['nombre']; ?></td>
        <td>

            <form action="actualizar_usuario.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $u['id']; ?>">

            <select name="rol">
                <option value="admin">Admin</option>
                <option value="camarero">Camarero</option>
                <option value="cocina">Cocina</option>
                <option value="conserje">Conserje</option>
            </select>

            </td>

            <td>

            <select name="turno">
                <option value="dia">Día</option>
                <option value="tarde">Tarde</option>
                <option value="noche">Noche</option>
            </select>

            <button type="submit">
            Actualizar
            </button>

            </form>

        </td>
        </tr>
        <?php }} ?>
        </table>

        <hr>

        <h2>🍺 Pedidos para tomar</h2>

        <table border="1" cellpadding="10">
        <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Estado</th>
        </tr>

        <?php if($pedidosTomar){ foreach($pedidosTomar as $p){ ?>
        <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo $p['nombre_cliente']; ?></td>
        <td><?php echo $p['estado']; ?></td>
        </tr>
        <?php }} ?>
        </table>

        <hr>

        <h2>🛵 Pedidos para llevar</h2>

        <table border="1" cellpadding="10">
        <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Estado</th>
        </tr>

        <?php if($pedidosLlevar){ foreach($pedidosLlevar as $p){ ?>
        <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo $p['nombre_cliente']; ?></td>
        <td><?php echo $p['estado']; ?></td>
        </tr>
        <?php }} ?>
        </table>

        <hr>

        <h2>📄 Solicitudes de Empleo</h2>

        <table border="1" cellpadding="10">

            <tr>
                <th>Nombre completo</th>
                <th>DNI</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Formulario</th>
                <th>Decisión</th>
            </tr>

            <?php if($solicitudes){ foreach($solicitudes as $s){ ?>

                <tr>

                    <td><?php echo $s['nombre']." ".$s['apellidos']; ?></td>

                    <td><?php echo $s['dni']; ?></td>

                    <td><?php echo $s['direccion']; ?></td>

                    <td><?php echo $s['correo']; ?></td>

                    <td>
                        <a href="<?php echo $s['pdf']; ?>" download>
                        <?php echo $s['nombre']; ?> ha solicitado trabajo
                        </a>
                    </td>

                    <td>

                    <a href="rechazar.php?id=<?php echo $s['id']; ?>">
                        <button class="btn-no">Rechazar</button>
                    </a>

                    <a href="contratar.php?id=<?php echo $s['id']; ?>">
                        <button class="btn-ok">Contratar</button>
                    </a>

                    </td>

                </tr>

            <?php }} ?>

        </table>

        <hr>

        <h2>📩 Mensajes de empleados</h2>

        <?php if($mensajes){ foreach($mensajes as $m){ ?>

        <p>
            <strong>[<?php echo $m['emisor']; ?>]</strong>
            <?php echo $m['mensaje']; ?>
            <a href="confirmar_mensaje_gerente.php?id=<?php echo $m['id']; ?>"
            style="text-decoration:none;font-size:22px;">
                <button class="btn-msg">👍 Confirmar</button>
            </a>
        </p>

        <?php }} ?>

    </body>

</html>