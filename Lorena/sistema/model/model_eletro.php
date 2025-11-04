<?php
    require_once "../config/db.php";
    require_once "model_estoque.php";
    require_once "model_logs.php";

    class Eletrodomestico{
        public function cadastrar_eletrodomesticos($nome, $fornecedor, $categoria, $potencia, $consumo_energetico, $garantia, $prioridade, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO ELETRODOMESTICO (ELETRO_NOME, ELETRO_FORNECEDOR, ELETRO_CATEGORIA, ELETRO_POTENCIA, ELETRO_CONSUMO_ENERGETICO, ELETRO_GARANTIA, ELETRO_PRIORIDADE, FK_USU_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("sssssssi", $nome, $fornecedor, $categoria, $potencia, $consumo_energetico, $garantia, $prioridade, $fk_usu_id);
            $success = $insert->execute();

            if($success){
                $eletro_id = $conn->insert_id;

                $estoque = new Estoque();
                $estoque->adicionar_estoque(0,$fk_usu_id,$eletro_id);

                $logs = new Logs();
                $logs->cadastrar_logs("Eletrodomestico <br> ID: ".$eletro_id." <br> NOME: ".$nome." <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: ".$fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function listar_eletro() {
            $conn = Database::getConnection();
            $sql = "SELECT      L.ELETRO_ID,
                                L.ELETRO_NOME,
                                L.ELETRO_FORNECEDOR,
                                L.ELETRO_CATEGORIA,
                                L.ELETRO_POTENCIA,
                                L.ELETRO_CONSUMO_ENERGETICO,
                                L.ELETRO_GARANTIA,
                                L.ELETRO_PRIORIDADE,
                                A.ESTOQUE_QUANTIDADE,
                                U.USU_NOME,
                                U.USU_EMAIL
                    FROM        ELETRODOMESTICO L
                    JOIN        USUARIO U ON L.FK_USU_ID = U.USU_ID
                    JOIN        ESTOQUE A ON L.ELETRO_ID = A.FK_ELETRO_ID
                    ORDER BY    L.ELETRO_NOME";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function excluir_eletrodomesticos($eletro_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $delete = $conn->prepare("DELETE FROM ELETRODOMESTICO WHERE ELETRO_ID = ?");
            $delete->bind_param("i", $eletro_id);

            $logs = new Logs();
            $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> AÇÃO: Excluído! <br> ID USUÁRIO: ".$fk_usu_id);
            
            $success = $delete->execute();
            $delete->close();
            return $success;
        }

        public function buscar_eletrodomesticos_pelo_id($id) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT      
                                            L.ELETRO_ID,
                                            L.ELETRO_NOME,
                                            L.ELETRO_FORNECEDOR,
                                            L.ELETRO_CATEGORIA,
                                            L.ELETRO_POTENCIA,
                                            L.ELETRO_CONSUMO_ENERGETICO,
                                            L.ELETRO_GARANTIA,
                                            L.ELETRO_PRIORIDADE,
                                            A.ESTOQUE_QUANTIDADE,
                                            U.USU_NOME,
                                            U.USU_EMAIL
                                         FROM       ELETRODOMESTICO L
                                        JOIN        USUARIO U ON L.FK_USU_ID = U.USU_ID
                                        JOIN        ESTOQUE A ON L.ELETRO_ID = A.FK_ELETRO_ID
                                        WHERE       L.ELETRO_ID = ?
                                        ORDER BY    L.ELETRO_NOME");
            $select->bind_param("i", $id);
            $select->execute();
            $result = $select->get_result();
            $doce = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $doce;
        }

        public function editar_eletrodomesticos($nome, $fornecedor, $categoria, $potencia, $consumo_energetico, $garantia, $prioridade, $eletro_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("UPDATE ELETRODOMESTICO SET ELETRO_NOME = ?, ELETRO_FORNECEDOR = ?, ELETRO_CATEGORIA = ?, ELETRO_POTENCIA = ?, ELETRO_CONSUMO_ENERGETICO = ?, ELETRO_GARANTIA = ?, ELETRO_PRIORIDADE = ? WHERE ELETRO_ID = ?");
            $insert->bind_param("sssssssi", $nome, $fornecedor, $categoria, $potencia, $consumo_energetico, $garantia, $prioridade, $eletro_id);
            $success = $insert->execute();

            if($success){
                $logs = new Logs();
                $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> NOME: ".$nome." <br> AÇÃO: Editado! <br> ID USUÁRIO: ".$fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function filtrar_eletrodomesticos($campo) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT      
                                                    L.ELETRO_ID,
                                                    L.ELETRO_NOME,
                                                    L.ELETRO_FORNECEDOR,
                                                    L.ELETRO_CATEGORIA,
                                                    L.ELETRO_POTENCIA,
                                                    L.ELETRO_CONSUMO_ENERGETICO,
                                                    L.ELETRO_GARANTIA,
                                                    L.ELETRO_PRIORIDADE,
                                                    A.ESTOQUE_QUANTIDADE,
                                                    U.USU_NOME,
                                                    U.USU_EMAIL
                                        FROM        ELETRODOMESTICO L
                                        JOIN        USUARIO U ON L.FK_USU_ID = U.USU_ID
                                        JOIN        ESTOQUE A ON L.ELETRO_ID = A.FK_ELETRO_ID
                                        WHERE       L.ELETRO_NOME LIKE ?
                                        ORDER BY    L.ELETRO_NOME");
            $termo = "%" . $campo . "%";
            $select->bind_param("s", $termo);
            $select->execute();
            $result = $select->get_result();
            $Eletrodomestico = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $Eletrodomestico;
        }
    }
?>