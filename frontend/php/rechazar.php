<?php

    require 'bbdd.php';

    $id = $_GET['id'];

    pg_query_params(
        $conn,
        "DELETE FROM solicitudes_empleo WHERE id=$1",
        array($id)
    );

    echo "
    <h1>Solicitud rechazada</h1>
    <p>Correo enviado automáticamente al solicitante</p>
    <a href='gerente.php'>Volver</a>
    ";

?>