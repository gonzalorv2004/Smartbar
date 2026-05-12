<?php

session_start();

require 'bbdd.php';

$userf = $_POST['username'] ?? '';
$passf = $_POST['pass'] ?? '';

$query = "SELECT * FROM usuarios WHERE nombre = $1";

$resultado = pg_query_params(
    $conn,
    $query,
    array($userf)
);

if (pg_num_rows($resultado) == 1) {

    $usuario = pg_fetch_assoc($resultado);

    if ($passf == $usuario['password']) {

        $_SESSION['user'] = $usuario['nombre'];

        header("Location: pedido.php");
        exit();

    } else {

        $_SESSION['error_login'] = true;

        header("Location: acceso.php");
        exit();
    }

} else {

    $_SESSION['error_login'] = true;

    header("Location: acceso.php");
    exit();
}

?>