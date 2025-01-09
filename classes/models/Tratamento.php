<?php
    class Tratamento{

        public $id;
        public $nome;
        public $descricao;

        function __construct($id = null, $nome = null, $descricao = null)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
        }

    }



?>