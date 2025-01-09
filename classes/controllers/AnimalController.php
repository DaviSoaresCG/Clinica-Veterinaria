<?php

    class AnimalController{
        function Listar(){
            $server = 'mysql:host=localhost;dbname=clinica';
            $user = 'root';
            $password = '';

            $lista=[];

            try{
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //sql para pegar todos os animais
            $sql = $pdo->prepare('select id_animal, nome_animal, cod_especie from animal');
            $sql->execute();


            //Uma maneira de pegar a especie de cada cachorro seria essa. Assim, formaria dois arrays contendo todos os ids e nomes das especies e depois eu faria um 'for' para percorrer cada id da especie procurando ser igual ao o cod_especie do animal

            //sql para pegar todas as especies
            // $sql_especie = $pdo->prepare('select id_especie, nome_especie from especie');
            // $sql_especie->execute();

            // $todos_id_especie = [];
            // $todas_especies = [];

            // while($dados_especie = $sql_especie->fetch(PDO::FETCH_ASSOC)){
            //    array_push($todos_id_especie, $dados_especie['id_especie']);
            //    array_push($todas_especies, $dados_especie['nome_especie']);
            // }

            while($dados = $sql->fetch(PDO::FETCH_ASSOC)){

                $id = $dados['id_animal'];
                $nome = $dados['nome_animal'];
                $cod_especie = $dados['cod_especie'];
                $nome_especie = '';

                //outra forma de buscar a especie de cada animal seria pegar outro codigo sql e fazer um where usando o cod_especie, como um inner join.
                $sql_especie = $pdo->prepare('select nome_especie from especie where id_especie = :codigo');
                $sql_especie->bindParam('codigo', $cod_especie);
                $sql_especie->execute();
                $dados_especie = $sql_especie->fetch(PDO::FETCH_ASSOC);
                $nome_especie = $dados_especie['nome_especie'];

                //o codigo comentado abaixo faz parte da primeira maneira que falei acima.
                // for($i=0; $i<count($todos_id_especie); $i++){
                //     if($todos_id_especie[$i]==$cod_especie){
                //         $nome_especie = $todas_especies[$i];
                //         break;
                //     }
                // }
                
                
                $especie = new Especie($cod_especie, $nome_especie);

                $animal = new Animal($id, $nome, $especie);
                //pega a lista e coloca na ultima posição
                array_push($lista, $animal);
            }
            
            $pdo = null;

            }catch(PDOException $e){
                echo "erro: " . $e->getMessage();
            }
            return  $lista;
    }

    function getAnimalNome($nome){
        $lista = [];
        $animalController = new AnimalController();
        $lista_animais = $animalController->Listar();

        for($i=0; $i<count($lista_animais); $i++){
            if(strtolower($lista_animais[$i]->nome)==$nome){
               array_push($lista, $lista_animais[$i]);
            }
        }
        return $lista;
    }

    function getAnimalId($id){
        $animal = [];
        $animalController = new AnimalController();
        $lista_animais = $animalController->Listar();

        for($i=0; $i<count($lista_animais); $i++){
            if(strtolower($lista_animais[$i]->id)==$id){
               array_push($animal, $lista_animais[$i]);
               break;
            }
        }
        return $animal;
    }
}


?>