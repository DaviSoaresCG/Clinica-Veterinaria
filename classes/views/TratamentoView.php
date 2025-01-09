<?php

    class TratamentoView{
        function getTratamentosView(){
            $tratamentoController = new TratamentoController();
            $tratamentos = $tratamentoController->getTratamentosController();
            return $tratamentos;
        }
    }

?>