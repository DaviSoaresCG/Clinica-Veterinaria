<?php

    class Especie{
        public $id;
        public $nome;

        function __construct($id = null, $nome = null)
        {
            $this->id = $id;
            $this->nome = $nome;
        }


    }

?>