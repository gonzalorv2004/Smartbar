<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    $query = "SELECT * FROM productos WHERE id = $1";
    $resultado = pg_query_params($conn, $query, array($id));
    $producto = pg_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8">
        <title>Editar producto</title>
        <link rel="stylesheet" href="../css/admin.css">
        
    </head>
    <body>

        <header>
            <h1>✏ Editar producto</h1>
        </header>

        <div class="pedido-box">
            <form action="guardar_producto.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

                Nombre:<br>
                <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"><br><br>

                Categoría:<br>
                <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>"><br><br>

                Precio:<br>
                <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>"><br><br>

                Stock:<br>
                <input type="number" name="stock" value="<?php echo $producto['stock']; ?>"><br><br>

                <button type="submit">Guardar cambios</button>

            </form>
        </div>

    </body>
</html>