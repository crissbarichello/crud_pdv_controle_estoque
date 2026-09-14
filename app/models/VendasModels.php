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
        if (empty($dados['itens']) || !in_array($dados['forma_pagamento'] ?? '', ['DINHEIRO', 'CARTAO', 'PIX'], true)) {
            return false;
        }

        $this->pdo->beginTransaction();

        try {
            $itens = [];
            $total = 0;

            foreach ($dados['itens'] as $item) {
                $produtoId = (int) ($item['produto_id'] ?? 0);
                $quantidade = (int) ($item['quantidade'] ?? 0);

                if ($produtoId < 1 || $quantidade < 1) {
                    throw new RuntimeException('Item de venda inválido.');
                }

                $stmt = $this->pdo->prepare(
                    'SELECT id, preco_venda, estoque
                     FROM produtos
                     WHERE id = ? AND ativo = 1
                     FOR UPDATE'
                );
                $stmt->execute([$produtoId]);
                $produto = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$produto || (int) $produto['estoque'] < $quantidade) {
                    throw new RuntimeException('Produto sem estoque suficiente.');
                }

                $preco = (float) $produto['preco_venda'];
                $subtotal = $preco * $quantidade;
                $total += $subtotal;
                $itens[] = [
                    'produto_id' => $produtoId,
                    'quantidade' => $quantidade,
                    'valor_unitario' => $preco,
                    'subtotal' => $subtotal
                ];
            }

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
                $total,
                $dados['forma_pagamento']
            ]);

            $vendaId = $this->pdo->lastInsertId();

            foreach ($itens as $item) {
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
