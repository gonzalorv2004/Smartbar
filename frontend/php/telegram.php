<?php

    function enviarTelegram($mensaje) {

        $token = "8952579067:AAGVhSilTLgBJXXz9MNCrb3xg9fGyCN4_B4";
        $chat_id = "1384116440";

        $url = "https://api.telegram.org/bot".$token."/sendMessage";

        $datos = [
            'chat_id' => $chat_id,
            'text' => $mensaje
        ];

        file_get_contents($url . "?" . http_build_query($datos));
    }

?>