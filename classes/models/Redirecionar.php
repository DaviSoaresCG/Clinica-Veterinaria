<?php

    class Redirecionar{
        public function atendimento($id){
            if(!$id){
                header('Location: index.php');
                exit;
            }
        }
    }

?>