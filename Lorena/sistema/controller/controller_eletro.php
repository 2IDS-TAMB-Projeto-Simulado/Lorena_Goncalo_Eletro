<?php
    require_once "../model/model_eletro.php";
    session_start();

    //CADASTRAR ELETRODOMESTICO
    if(isset($_POST["cadastrar_eletro"])){
        $eletrodomestico = new Eletrodomestico();
        $resultado = $eletrodomestico->cadastrar_eletrodomesticos($_POST["nome"], $_POST["fornecedor"], $_POST["categoria"],$_POST["potencia"],$_POST["consumo_energetico"],$_POST["garantia"],$_POST["prioridade"], $_SESSION['usuario']["USU_ID"], $_POST["quantidade"]);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico cadastrado com sucesso!');
                    window.location.href='../view/listar_eletro.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao cadastrar eletrodoméstico!');
                    window.location.href='../view/listar_eletro.php';
                </script>";
        }
        exit();
    }

    //BUSCAR DADOS PARA EDITAR LIVRO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "editar_eletro"){
        $eletrodomestico = new Eletrodomestico();
        $resultados = $eletrodomestico->buscar_eletrodomesticos_pelo_id($_GET["id"]);

        if(!empty($resultados)) {
            $eletrodomestico_editar = $resultados[0];
        } else {
            echo "<script>
                    alert('Eletrodoméstico não encontrado!');
                    window.location.href='listar_eletro.php';
                </script>";
            exit();
        }
    }

    //EDITAR LIVRO
    if(isset($_POST["editar_eletro"])){
        $eletrodomestico = new Eletrodomestico();
        $resultado = $eletrodomestico->editar_eletrodomesticos($_POST["nome"], $_POST["fornecedor"], $_POST["categoria"],$_POST["potencia"],$_POST["consumo_energetico"],$_POST["garantia"],$_POST["prioridade"], $_GET["id"], $_SESSION['usuario']["USU_ID"]);
        if($resultado){
            echo "<script>
                    alert('Eletrodomestico atualizado com sucesso!');
                    window.location.href='../view/listar_eletro.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao atualizar eletrodomestico!');
                    window.location.href='../view/listar_eletro.php';
                </script>";
        }
        exit();
    }

    //EXCLUIR LIVRO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "excluir_eletrodomesticos"){
        $eletrodomestico = new Eletrodomestico();
        $resultado = $eletrodomestico->excluir_eletrodomesticos($_GET["id"], $_SESSION['usuario']['USU_ID']);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico excluído com sucesso!');
                    window.location.href='../view/listar_eletro.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao excluir eletrodoméstico!');
                    window.location.href='../view/listar_eletro.php';
                </script>";
        }
        exit();
    }
?>