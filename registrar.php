<?php

    include_once('config.php');

    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id_animal = $_POST['id_animal'];

        $prontuarioController = new ProntuarioController;
        $quantidade_antes = count($prontuarioController->getProntuairiosIdController($id_animal));

        $data = new DateTime();
        $data->modify('-4 hours');
        $data_atendimento = $data->format('Y-m-d H:i:s');
        $observacao = $_POST['observacao'];
        $tratamento = $_POST['tratamento'];
    
        $prontuarioController = new ProntuarioController();
        $prontuario = $prontuarioController->setProntuarioController($id_animal,$data_atendimento, $tratamento, $observacao);
        
        $quantidade_depois = count($prontuarioController->getProntuairiosIdController($id_animal));

        if($quantidade_antes == $quantidade_depois){
            echo 'erro: '. $prontuario;
        }else{
            $mensagem = "CADASTRADO COM SUCESSO!!! IUPIIII";
            
            header('Location: atendimento.php?id='.$id_animal);
            exit;
        }
        
        
    }
    


?>