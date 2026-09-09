<?php

class VendaModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarVendas()
    {
        $sql = "
            SELECT *
            FROM vendas
            ORDER BY data_venda DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarVenda($id)
    {
        $sql = "
            SELECT *
            FROM vendas
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvarVenda($dados)
    {
        $this->pdo->beginTransaction();

        try {
            $sql = "
                INSERT INTO vendas
                (
                    total,
                    forma_pagamento
                )
                VALUES
                (
                    ?, ?
                )
            ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $dados['total'],
                $dados['forma_pagamento']
            ]);

            $vendaId = $this->pdo->lastInsertId();

            foreach ($dados['itens'] as $item) {
                $sql = "
                    INSERT INTO itens_venda
                    (
                        venda_id,
                        produto_id,
                        quantidade,
                        valor_unitario,
                        subtotal
                    )
                    VALUES
                    (
                        ?, ?, ?, ?, ?
                    )
                ";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    $vendaId,
                    $item['produto_id'],
                    $item['quantidade'],
                    $item['valor_unitario'],
                    $item['subtotal']
                ]);

                $sql = "
                    UPDATE produtos
                    SET estoque = estoque - ?
                    WHERE id = ?
                ";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    $item['quantidade'],
                    $item['produto_id']
                ]);

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
                        ?, 'SAIDA', ?, ?
                    )
                ";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    $item['produto_id'],
                    $item['quantidade'],
                    "Venda #{$vendaId}"
                ]);
            }

            $this->pdo->commit();

            return $vendaId;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
