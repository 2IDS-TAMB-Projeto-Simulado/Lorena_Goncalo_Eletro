<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Cadastro de Eletrodomesticos</title>
    </head>
    <body>
        <h1>Cadastro de Eletrodomesticos</h1>
        <form action="./../controller/controller_eletro.php" method="POST">
            <label>Nome:</label>
            <br>
            <input type="text" id="nome" name="nome" required>

            <br>
            <br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" required>
            <br>
            <br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" required>

            <br>
            <br>

            <label>Potência:</label>
            <br>
            <input type="text" id="potencia" name="potencia" required>

            <br>
            <br>

            <label>Consumo Energético:</label>
            <br>
            <input type="text" id="consumo_energetico" name="consumo_energetico" required>

            <br>
            <br>
 
            <label>Garantia:</label>
            <br>
            <input type="date" id="garantia" name="garantia" required>

            <br>
            <br>

            <label>Prioridade:</label>
            <br>
            <input type="text" id="prioridade" name="prioridade" required>

            <br>
            <br>

            <input type="submit" id="cadastrar_eletro" name="cadastrar_eletro" value="Cadastrar">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>