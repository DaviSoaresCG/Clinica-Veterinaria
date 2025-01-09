<?php

    class Prontuario{

        public $animal;
        public $tratamento;
        public $data;
        public $observacao;

        function __construct(Animal $animal = null, Tratamento $tratamento = null, $data = null, $observacao = null){
            $this->animal = $animal;
            $this->tratamento = $tratamento;
            $this->data = $data;
            $this->observacao = $observacao;
        }

    }

?>