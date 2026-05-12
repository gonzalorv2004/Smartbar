<?php

    require 'bbdd.php';

    if($conn){
        echo "Conexión PostgreSQL correcta";
    }else{
        echo "Error de conexión";
    }

?>