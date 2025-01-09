<?php
require_once('config.php');

    $buscar = false;
    $valor = '';
    if(isset($_GET['valorBusca'])){
        
        $buscar = true;
        if($_GET['valorBusca'] != ''){
            $valor = strtolower($_GET['valorBusca']);
        }

    }else{

    }
    
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style/style.css'>
    <title>Prontuário Veterinário</title>
</head>
<body>
    <form id="area-busca" action="index.php" method="get">
            <input type="text" name='valorBusca' placeholder="Informe nome do animal">
            <button>Buscar por nome</button>
    </form>
    

    <section id="resultados">

    <?php
    $animalView = new AnimalView();
        if($buscar){
            if($valor == ''){
                $animalView->getAnimais();    
        }else{
            $animalView->getAnimalNome($valor);  
        }
    }

    ?>

</body>
</html>