<?php

// LOCAL: app/Controllers/ProdutoController.php

require_once "../app/Models/ProdutoModels.php";

class ProdutoController
{
    // Tela principal
    public function home_produto($pdo, $id = null)
    {
        $model = new ProdutoModel($pdo);

        $produtos = $model->buscarTodos();
        $produtoEditando = null;

        if ($id) {
            $produtoEditando = $model->buscarPorId($id);
        }

        require "../app/Views/produtos/index.php";
    }

    // CREATE
    public function cadastrar_produto($pdo)
    {
        $model = new ProdutoModel($pdo);

        $model->criar($_POST);

        header("Location: index.php?modulo=produto");
        exit;
    }

    // UPDATE
    public function atualizar_produto($pdo, $id)
    {
        $model = new ProdutoModel($pdo);

        $model->atualizar($id, $_POST);

        header("Location: index.php?modulo=produto");
        exit;
    }

    // DELETE
    public function excluir_produto($pdo, $id)
    {
        $model = new ProdutoModel($pdo);

        $model->excluir($id);

        header("Location: index.php?modulo=produto");
        exit;
    }
}