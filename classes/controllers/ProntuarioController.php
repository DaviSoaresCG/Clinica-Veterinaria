<?php

    class ProntuarioController{
        function getProntuariosController(){
            $server = 'mysql:host=localhost;dbname=clinica';
            $user = 'root';
            $password = '';

            $lista_prontuarios = [];
            try{
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare('select * from prontuario');
            $sql->execute();

            while($dados_prontuario = $sql->fetch(PDO::FETCH_ASSOC)){
                $cod_animal = $dados_prontuario['cod_animal'];
                $cod_tratamento = $dados_prontuario['cod_tratamento'];
                $data_sessao = $dados_prontuario['data_sessao'];
                $observacao = $dados_prontuario['observacao'];

                $animalController = new AnimalController();
                $animal = $animalController->getAnimalId($cod_animal);
                $animal2 = new Animal($cod_animal, $animal[0]->nome, $animal[0]->especie);

                $tratamentoController = new TratamentoController();
                $tratamento = $tratamentoController->getTratamentosIdController($cod_tratamento);

                $prontuario = new Prontuario($animal2, $tratamento, $data_sessao, $observacao);
                array_push($lista_prontuarios, $prontuario);
            }
            return $lista_prontuarios;
          
            }catch(PDOException $e){
                echo "erro: " . $e->getMessage();
            }
        }

        function getProntuairiosIdController($id){
            $server = 'mysql:host=localhost;dbname=clinica';
            $user = 'root';
            $password = '';

            try{
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare('select * from prontuario where cod_animal = :codigo');
            $sql->bindParam('codigo', $id);
            $sql->execute();

            $prontuarios = [];
            while($dados_prontuario = $sql->fetch(PDO::FETCH_ASSOC)){
                $cod_animal = $dados_prontuario['cod_animal'];
                $cod_tratamento = $dados_prontuario['cod_tratamento'];
                $data = $dados_prontuario['data_sessao'];
                $observacao = $dados_prontuario['observacao'];

                $animalController = new AnimalController();
                $pega_animal = $animalController->getAnimalId($cod_animal);
                $animal = new Animal($cod_animal, $pega_animal[0]->nome, $pega_animal[0]->especie);

                $tratamentoController = new TratamentoController();
                $tratamento = $tratamentoController->getTratamentosIdController($cod_tratamento);

                $prontuario = new Prontuario($animal, $tratamento, $data, $observacao);
                array_push($prontuarios, $prontuario);
            }
                
            return $prontuarios;
          
            }catch(PDOException $e){
                echo "erro: " . $e->getMessage();
            }
        }

        function setProntuarioController($id_animal, $data, $tratamento, $observacao){
            $server = 'mysql:host=localhost;dbname=clinica';
            $user = 'root';
            $password = '';

            try{
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = $pdo->prepare("INSERT INTO `prontuario`(`cod_animal`, `cod_tratamento`, `data_sessao`, `observacao`) VALUES (:id_animal, :tratamento, :data,  :observacao)");
            $sql->bindParam('id_animal', $id_animal);
            $sql->bindParam('data', $data);
            $sql->bindParam('tratamento', $tratamento);
            $sql->bindParam('observacao', $observacao);
            $sql->execute();


          
            }catch(PDOException $e){
                return "erro: " . $e->getMessage();
            }
        }
    }

?>