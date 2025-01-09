<?php

    class ProntuarioView{
        function getProntuariosIdView($id){
            $prontuarioController = new ProntuarioController;
            $prontuarios = $prontuarioController->getProntuairiosIdController($id);
    
            echo "<table>
            <thead>
                <th>Data</th>
                <th>Tratamento</th>
                <th>Observações do Tratamento</th>
            </thead>
            <tbody>";
            for($i=0; $i<count($prontuarios); $i++){
                $data = new DateTime($prontuarios[$i]->data);
                $data_formatada = $data->format('d/m/y \à\s H:i');
            echo "<tr>
                    <td class='data'>".htmlspecialchars($data_formatada)."</td>
                    <td>".htmlspecialchars($prontuarios[$i]->tratamento->nome)."</td>
                    <td>".htmlspecialchars($prontuarios[$i]->observacao)."</td>
                </tr>";
            }
            echo "</tbody>
        </table>";
    
        }
    }

?>