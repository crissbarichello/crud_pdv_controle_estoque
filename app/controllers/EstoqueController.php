<?php

require_once "../app/Models/EstoqueModel.php";

class EstoqueController
{
    public function home_estoque($pdo)
    {
        $model = new EstoqueModel($pdo);

        $movimentacoes = $model->buscarMovimentacoes();

        require "../app/Views/estoque/index.php";
    }

    public function movimentar($pdo)
    {
        $model = new EstoqueModel($pdo);

        $model->movimentar($_POST);

        header("Location: index.php?modulo=estoque");
        exit;
    }
}