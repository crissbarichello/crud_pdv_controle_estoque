<?php

require_once "../app/Models/VendasModels.php";
require_once "../app/Models/ProdutoModels.php";

class VendaController
{
    public function home_pdv($pdo)
    {
        $produtos = (new ProdutoModel($pdo))->buscarTodos();
        require "../app/Views/pdv/index.php";
    }

    public function finalizar_venda($pdo)
    {
        $model = new VendaModel($pdo);

        $_POST['itens'] = json_decode($_POST['itens'] ?? '[]', true) ?: [];
        $vendaId = $model->salvarVenda($_POST);

        $status = $vendaId ? 'ok&id=' . (int) $vendaId : 'erro';
        header("Location: index.php?controller=pdv&status={$status}");
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