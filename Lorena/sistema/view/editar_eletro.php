<?php
require_once "./../controller/controller_eletro.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Editar Eletrodomesticos</title>
    </head>
    <body>
        <h1>Editar Eletrodomesticos</h1>
        <form action="" method="POST">
            <label>Nome:</label>
            <br>
            <input type="text" id="nome" name="nome" value="<?php echo $eletrodomestico_editar["ELETRO_NOME"]; ?>" required>

            <br>
            <br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" value="<?php echo $eletrodomestico_editar["ELETRO_FORNECEDOR"]; ?>" required>
            <br>
            <br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" value="<?php echo $eletrodomestico_editar["ELETRO_CATEGORIA"]; ?>" required>

            <br>
            <br>

            <label>Consumo Energético:</label>
            <br>
            <input type="text" id="consumo_energetico" name="consumo_energetico" value="<?php echo $eletrodomestico_editar["ELETRO_CONSUMO_ENERGETICO"]; ?>" required>

            <br>
            <br>

             <label>Potência:</label>
            <br>
            <input type="text" id="potencia" name="potencia" value="<?php echo $eletrodomestico_editar["ELETRO_POTENCIA"]; ?>" required>

            <br>
            <br>

             <label>Garantia:</label>
            <br>
            <input type="date" id="garantia" name="garantia" value="<?php echo $eletrodomestico_editar["ELETRO_GARANTIA"]; ?>" required>

            <br>
            <br>

            <label>Prioridade:</label>
            <br>
            <input type="text" id="prioridade" name="prioridade" value="<?php echo $eletrodomestico_editar["ELETRO_PRIORIDADE"]; ?>" required>

            <br>
            <br>

            <input type="submit" id="editar_eletro" name="editar_eletro" value="Salvar Alterações">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>