<?php

class ProdutoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY descricao ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        $sql = "INSERT INTO produtos (
                    codigo,
                    descricao,
                    custo,
                    preco_venda,
                    estoque,
                    ativo
                ) VALUES (
                    ?, ?, ?, ?, ?, ?
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $dados['codigo'],
            $dados['descricao'],
            $dados['custo'],
            $dados['preco_venda'],
            $dados['estoque'],
            $dados['ativo']
        ]);
    }

    public function atualizar($id, $dados)
    {
        $sql = "UPDATE produtos
                SET
                    codigo = ?,
                    descricao = ?,
                    custo = ?,
                    preco_venda = ?,
                    estoque = ?,
                    ativo = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $dados['codigo'],
            $dados['descricao'],
            $dados['custo'],
            $dados['preco_venda'],
            $dados['estoque'],
            $dados['ativo'],
            $id
        ]);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}