<?php

    require 'php/bbdd.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $dni = $_POST["dni"];
        $correo = $_POST["correo"];
        $fecha = $_POST["fecha"];
        $direccion = $_POST["direccion"];
        $genero = $_POST["genero"];
        $puesto = $_POST["puesto"];
        $motivo = $_POST["motivo"];

        $curriculum = time() . "_" . basename($_FILES["curriculum"]["name"]);
        $ruta_curriculum = "curriculums/" . $curriculum;

        move_uploaded_file($_FILES["curriculum"]["tmp_name"], $ruta_curriculum);

        $query = "
        INSERT INTO solicitudes
        (nombre, telefono, dni, correo, direccion, curriculum)
        VALUES ($1,$2,$3,$4,$5,$6)
        ";

        pg_query_params($conn, $query, array(
            $nombre,
            $telefono,
            $dni,
            $correo,
            $direccion,
            $ruta_curriculum
        ));

        header("Location: php/acceso.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8">
        <title>Solicitud de empleo - SmartBar</title>
        <link rel="stylesheet" href="css/solicitud.css">

    </head>
    <body>

        <div class="contenedor">
            <head>
                <meta charset="UTF-8">
                <title>Solicitud de empleo - SmartBar</title>
                <link rel="stylesheet" href="css/solicitud.css">
            </head>

            <form method="POST" enctype="multipart/form-data">

                <label>Nombre y apellidos</label>
                <input type="text" name="nombre" required>

                <label>Teléfono</label>
                <input type="text" name="telefono" required>

                <label>DNI</label>
                <input type="text" name="dni" required>

                <label>Correo electrónico</label>
                <input type="email" name="correo" required>

                <label>Foto</label>
                <input type="file" name="foto" required>

                <label>Fecha de nacimiento</label>
                <input type="date" name="fecha" required>

                <label>Dirección</label>
                <input type="text" name="direccion" required>

                <label>Género</label>
                <select name="genero">
                    <option value="">Seleccionar</option>
                    <option>Hombre</option>
                    <option>Mujer</option>
                </select>

                <label>Puesto solicitado</label>
                <select name="puesto" required>
                    <option>Camarero</option>
                    <option>Cocinero</option>
                    <option>Conserje</option>
                    <option>Administrador</option>
                </select>

                <label>¿Por qué deberíamos contratarte?</label>
                <textarea name="motivo" required></textarea>

                <label>Currículum</label>
                <input type="file" name="curriculum" required>

                <button type="submit">Guardar solicitud</button>

                <a class="volver" href="php/acceso.php">Volver al login</a>

            </form>
        </div>

    </body>
</html>