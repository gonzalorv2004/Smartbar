<?php

    require 'bbdd.php';

    $id = $_GET['id'];
    $turno = $_GET['turno'];

    $solicitud = pg_fetch_assoc(
        pg_query_params(
            $conn,
            "SELECT * FROM solicitudes_empleo WHERE id=$1",
            array($id)
        )
    );

    pg_query_params(
        $conn,
        "INSERT INTO usuarios (nombre,password,rol,turno)
        VALUES ($1,$2,$3,$4)",
        array(
            $solicitud['nombre'],
            '1234',
            'camarero',
            $turno
        )
    );

    pg_query_params(
        $conn,
        "DELETE FROM solicitudes_empleo WHERE id=$1",
        array($id)
    );

    echo "
    <h1>Empleado contratado</h1>
    <p>Asignado al turno: $turno</p>
    <a href='gerente.php'>Volver</a>
    ";

?>