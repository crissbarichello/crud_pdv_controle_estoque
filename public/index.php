<?php
require_once "../config/conexao.php";

$controller = $_GET['controller'] ?? $_GET['modulo'] ?? 'inicio';
$action = $_GET['action'] ?? 'home';

switch ($controller) {
    case 'produto':
        require_once "../app/controllers/ProdutoController.php";
        $obj = new ProdutoController();
        if ($action === 'cadastrar') {
            $obj->cadastrar_produto($pdo);
        } elseif ($action === 'atualizar') {
            $obj->atualizar_produto($pdo, $_GET['id']);
        } elseif ($action === 'excluir') {
            $obj->excluir_produto($pdo, $_GET['id']);
        } else {
            $obj->home_produto($pdo, $action === 'editar' ? ($_GET['id'] ?? null) : null);
        }
        break;
    case 'estoque':
        require_once "../app/controllers/EstoqueController.php";
        $obj = new EstoqueController();
        if ($action === 'movimentar') {
            $obj->movimentar($pdo);
        } else {
            $obj->home_estoque($pdo);
        }
        break;
    case 'pdv':
        require_once "../app/controllers/VendaController.php";
        $obj = new VendaController();
        if ($action === 'finalizar') {
            $obj->finalizar_venda($pdo);
        } else {
            $obj->home_pdv($pdo);
        }
        break;
    case 'vendas':
        require_once "../app/controllers/VendaController.php";
        $obj = new VendaController();
        $action === 'detalhes'
            ? $obj->detalhes_venda($pdo, $_GET['id'])
            : $obj->listar_vendas($pdo);
        break;
    default:
        require_once "../app/views/home.php";
}