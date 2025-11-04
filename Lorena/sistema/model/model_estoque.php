<?php
    require_once "../config/db.php";
    require_once "model_logs.php";

    class Estoque{
        public function adicionar_estoque($quantidade, $fk_usu_id, $fk_eletro_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO ESTOQUE (ESTOQUE_QUANTIDADE, FK_ELETRO_ID) VALUES (?, ?)");
            $insert->bind_param("ii", $quantidade, $fk_eletro_id);
            $success = $insert->execute(); 
            $insert->close();
            return $success;
        }
        public function atualizar_estoque($quantidade, $fk_eletro_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $update = $conn->prepare("UPDATE ESTOQUE SET ESTOQUE_QUANTIDADE = ? WHERE FK_ELETRO_ID = ?");
            $update->bind_param("ii", $quantidade, $fk_eletro_id);
            $success = $update->execute();

            if($success){
                $logs = new Logs();
                $logs->cadastrar_logs("Eletrodomestico <br> ID: ".$fk_eletro_id." <br> AÇÃO: Estoque editado <br> NOVA QTD: ".$quantidade."<br> ID USUÁRIO: ".$fk_usu_id);
            }
            $update->close();
            return $success;
        }
    }
?>