<?php

require_once "../app/Models/VendaModel.php";

class VendaController
{
    public function home_pdv($pdo)
    {
        require "../app/Views/pdv/index.php";
    }

    public function finalizar_venda($pdo)
    {
        $model = new VendaModel($pdo);

        $model->salvarVenda($_POST);

        header("Location: index.php?modulo=pdv");
        exit;
    }

    public function listar_vendas($pdo)
    {
        $model = new VendaModel($pdo);

        $vendas = $model->buscarVendas();

        require "../app/Views/vendas/index.php";
    }

    public function detalhes_venda($pdo, $id)
    {
        $model = new VendaModel($pdo);

        $venda = $model->buscarVenda($id);

        require "../app/Views/vendas/detalhes.php";
    }
}