<?php

    require 'bbdd.php';

    $id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Elegir turno</title>
    </head>

    <body>

        <h1>Elegir turno</h1>

        <a href="procesar_contratacion.php?id=<?php echo $id; ?>&turno=dia">
            <button>Día</button>
        </a>

        <a href="procesar_contratacion.php?id=<?php echo $id; ?>&turno=tarde">
            <button>Tarde</button>
        </a>

        <a href="procesar_contratacion.php?id=<?php echo $id; ?>&turno=noche">
            <button>Noche</button>
        </a>

    </body>
</html>