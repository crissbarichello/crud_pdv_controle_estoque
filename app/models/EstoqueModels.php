<?php

class EstoqueModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarMovimentacoes()
    {
        $sql = "
            SELECT
                m.*,
                p.descricao
            FROM movimentacoes_estoque m
            INNER JOIN produtos p ON p.id = m.produto_id
            ORDER BY m.data_movimento DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function movimentar($dados)
    {
        $this->pdo->beginTransaction();

        try {
            $sql = "
                INSERT INTO movimentacoes_estoque
                (
                    produto_id,
                    tipo,
                    quantidade,
                    observacao
                )
                VALUES
                (
                    ?, ?, ?, ?
                )
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                $dados['produto_id'],
                $dados['tipo'],
                $dados['quantidade'],
                $dados['observacao']
            ]);

            if ($dados['tipo'] == 'ENTRADA') {
                $sql = "
                    UPDATE produtos
                    SET estoque = estoque + ?
                    WHERE id = ?
                ";
            } else {
                $sql = "
                    UPDATE produtos
                    SET estoque = estoque - ?
                    WHERE id = ?
                ";
            }

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                $dados['quantidade'],
                $dados['produto_id']
            ]);

            $this->pdo->commit();

            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
