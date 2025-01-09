<?php

    class MensagemController{
        public $mensagem;
        function __construct($mensagem = null)
        {
            $this->mensagem = $mensagem;
        }
    }

?>