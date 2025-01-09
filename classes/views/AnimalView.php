<?php

    class AnimalView{
        function getAnimais(){
            $animalController = new AnimalController();
            $lista_animais = $animalController->Listar();

            for($i = 0; $i<count($lista_animais); $i++){
               // echo '<p>'.$lista_animais[$i]->nome.'</p>';

                echo '<div class="caixaAnimal">
            <a href="atendimento.php?id='.$lista_animais[$i]->id.'">
                <img src="images/'.$lista_animais[$i]->nome.'.png">    
                <div>
                    <h1>'.$lista_animais[$i]->id.'</h1>
                    <h1>'.$lista_animais[$i]->nome.'</h1>
                    <p>'.$lista_animais[$i]->especie->nome.'</p>
                </div>
            </a>
        </div>';
            }
        }

        function getAnimalNome($nome){
            $animalController = new AnimalController();
            $animal = $animalController->getAnimalNome($nome);

            if(!empty($animal)){
            
                for($i = 0; $i<count($animal); $i++){
                    // echo '<p>'.$lista_animais[$i]->nome.'</p>';
    
                    echo '<div class="caixaAnimal">
                <a href="atendimento.php?id='.$animal[$i]->id.'">
                    <img src="images/'.$animal[$i]->nome.'.png">    
                    <div>
                    <h1>'.$animal[$i]->id.'</h1>
                        <h1>'.$animal[$i]->nome.'</h1>
                        <p>'.$animal[$i]->especie->nome.'</p>
                    </div>
                </a>
            </div>';
                }
            }else{
                echo "<p>Não foi encontrado nehnum animal!</p>";
            }

            
        }

        function getAnimalId($id){
            $animalController = new AnimalController();
            $animal = $animalController->getAnimalId($id);
            return $animal;
        }
    }

?>