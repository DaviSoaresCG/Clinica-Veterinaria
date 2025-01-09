<?php
require_once('config.php');

//verificar se a pagina está com o GET. Senão, redireciona à index
$redirecionar = new Redirecionar();
$redirecionar->atendimento($_GET);

if($_SERVER['REQUEST_METHOD'] === 'GET'){
$id = $_GET['id'];
$animalView = new AnimalView();
$animal = $animalView->getAnimalId($id);
$tratamentoView = new TratamentoView();
$tratamentos = $tratamentoView->getTratamentosView();
$data = new DateTime();
$data->modify('-4 hours');

}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Veterinária</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/atendimento.css">
</head>
<body>
    <section id="area-titulo">
        <h1>Atendimento</h1>
        <a href="index.php" class="botao">Voltar</a>
    </section>

    <section id="area-tratamento">
        <h1>Registro de atendimento</h1>
        <form action="registrar.php" method="post">
            <div class="item-form">
                <label>Nome do animal:</label>
                <input type="text" disabled value="<?php echo $animal[0]->nome?>">
                <input type="hidden" name="id_animal" value="<?php echo $animal[0]->id; ?>">
            </div>

            <div class="item-form">
                <label>Data:</label>
                <input type="text" disabled value="<?php echo $data->format('d-m-Y'); ?>">
            </div>

            <div class="item-form">
                <label>Tratamento:</label>
                <select id="opcoes" onchange="mostrarTexto()" name='tratamento'>
                    <option selected disabled>Selecione o Tratamento</option>
                    <?php
                        foreach ($tratamentos as $tratamento) {
                            echo "<option value='" . $tratamento->id . "'>" . $tratamento->nome . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="item-form-bloco">
                <label>Descrição do Tratamento:</label>
                <textarea rows="2" disabled id="textarea" name="texto"></textarea>
            </div>

            <div class="item-form-bloco">
                <label>Observações do Tratamento:</label>
                <textarea rows="6" name='observacao'></textarea>
            </div>

            <button class="botao">Salvar</button>
        </form>
    </section>

    <section id="area-historico">
        <h1>Histórico</h1>
        <?php
        
        $prontuarioView = new ProntuarioView();
        $prontuarioView->getProntuariosIdView($animal[0]->id);
                        
        ?>
    </section>

    <script>
        // Definir um objeto de tratamentos com ids e descrições
        const tratamentos = <?php
            $tratamentosArray = [];
            foreach ($tratamentos as $tratamento) {
                $tratamentosArray[] = [
                    'id' => $tratamento->id,
                    'descricao' => addslashes($tratamento->descricao)
                ];
            }
            echo json_encode($tratamentosArray);
        ?>;

        // Função para mostrar a descrição no textarea ao selecionar o tratamento
        function mostrarTexto() {
            // Recupera o valor da opção selecionada
            const opcao = document.getElementById('opcoes').value;
            let texto = '';

            // Encontra o tratamento selecionado e exibe a descrição
            const tratamentoSelecionado = tratamentos.find(t => t.id == opcao);
            if (tratamentoSelecionado) {
                texto = tratamentoSelecionado.descricao;
            }

            // Exibe o texto no textarea
            document.getElementById('textarea').value = texto;
        }
    </script>
</body>
</html>
