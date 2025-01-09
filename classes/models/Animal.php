<?php
class Animal{
    public $id;
    public $nome;
    public $especie;

    function __construct($id = null, $nome = null, Especie $especie = null)
    {
        $this->id = $id;
        $this->nome = $nome;

        $this->especie = $especie ?? new Especie();
        
    }
}

?>