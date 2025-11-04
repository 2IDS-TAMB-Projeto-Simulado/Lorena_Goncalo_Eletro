<?php
require_once "./../controller/controller_eletro.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$eletrodomestico = new Eletrodomestico();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $eletrodomestico->filtrar_eletrodomesticos($_POST['pesquisar']);
} 
else {
    $resultados = $eletrodomestico->listar_eletro();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Gestão de Estoque</title>
        <style>
            table{
                border-collapse:collapse;
            }
            tr, td, th{
                padding: 12px;
            }
        </style>
    </head>
    <body>
        <h1>Gestão de Estoque</h1>
        <form method="POST">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>
        
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Fornecedor</th>
                <th>Categoria</th>
                <th>Consumo Energético</th>
                <th>Potência</th>
                <th>Garantia</th>
                <th>Prioridade</th>
                <th>Ação</th>
                <th>Quantidade</th>
                <th>Atualizar Estoque</th>
            </tr>
            <?php
                if(count($resultados) > 0){
                    foreach($resultados as $r){
                        echo "<form method='POST' action='./../controller/controller_estoque.php'>";
                        echo "<tr>";  
                        echo "<td><input type='number' name='eletro_id' id='eletro_id' value='".$r["ELETRO_ID"]."' readonly></td>";
                        echo "<td>".$r["ELETRO_NOME"]."</td>";
                        echo "<td>".$r["ELETRO_FORNECEDOR"]."</td>";
                        echo "<td>".$r["ELETRO_CATEGORIA"]."</td>";
                        echo "<td>".$r["ELETRO_CONSUMO_ENERGETICO"]."</td>";
                        echo "<td>".$r["ELETRO_POTENCIA"]."</td>";
                        echo "<td>".$r["ELETRO_GARANTIA"]."</td>";
                        echo "<td>".$r["ELETRO_PRIORIDADE"]."</td>";
                        echo "<td><input type='number' name='estoque_qtd' id='estoque_qtd' value='".$r["ESTOQUE_QUANTIDADE"]."' readonly></td>";
                        echo "<td>
                                    <select id='acao_estoque' name='acao_estoque'>
                                        <option value=''>Selecione...</option>
                                        <option value='entrada'>Entrada no Estoque</option>
                                        <option value='saida'>Saída do Estoque</option>
                                    </select>
                                </td>";
                        echo " <td>
                                    <input type='number' id='qtd_aumentar_diminuir' name='qtd_aumentar_diminuir' min='0'>
                                </td>";
                        echo "<td><input type='submit' id='botao_atualizar' name='botao_atualizar' value='Atualizar Estoque'></td>";
                        echo "</tr>";    
                        echo "</form>";                        
                    }
                }
                else{
                    echo "<tr>";  
                    echo "<th colspan='6'>Nenhum eletrodoméstico cadastrado!</th>";
                    echo "</tr>";       
                }
            ?>
        </table>
        <br>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>