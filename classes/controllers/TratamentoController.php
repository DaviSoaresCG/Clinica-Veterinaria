<?php

    class TratamentoController{
        function getTratamentosController(){
            $server = 'mysql:host=localhost;dbname=clinica';
            $user = 'root';
            $password = '';

            $lista_tratamentos = [];
            try{
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare('select * from tratamento');
            $sql->execute();

            while($dados_tratamento = $sql->fetch(PDO::FETCH_ASSOC)){
                $id = $dados_tratamento['id_tratamento'];
                $nome = $dados_tratamento['nome_tratamento'];
                $descricao = $dados_tratamento['descricao'];

                $tratamento = new Tratamento($id, $nome, $descricao);
                array_push($lista_tratamentos, $tratamento);
            }
            return $lista_tratamentos;
          
            }catch(PDOException $e){
                echo "erro: " . $e->getMessage();
            }
        }

        function getTratamentosIdController($id){
            $server = 'mysql:host=localhost;dbname=clinica';
            $user = 'root';
            $password = '';

            try{
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare('select * from tratamento where id_tratamento = :codigo');
            $sql->bindParam('codigo', $id);
            $sql->execute();

            $dados_tratamento = $sql->fetch(PDO::FETCH_ASSOC);
                $id_tratamento = $dados_tratamento['id_tratamento'];
                $nome = $dados_tratamento['nome_tratamento'];
                $descricao = $dados_tratamento['descricao'];

                $tratamento = new Tratamento($id_tratamento, $nome, $descricao);
                
            
            return $tratamento;
          
            }catch(PDOException $e){
                echo "erro: " . $e->getMessage();
            }
        }
    }

?>