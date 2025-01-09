<?php
    class MensagemView{
        function setMensagemView($mensagem){
            $mensagemController = new MensagemController($mensagem);
            echo $mensagemController->mensagem;

        }
    }

?>