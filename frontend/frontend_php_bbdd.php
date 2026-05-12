<?php

$conn = pg_connect("
    host=database
    port=5432
    dbname=smartbar
    user=smartbar
    password=smartbar123
");

if (!$conn) {
    die("Error de conexión PostgreSQL");
}

?>