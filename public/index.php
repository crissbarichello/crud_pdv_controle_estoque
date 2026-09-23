<?php
session_start();

require_once "../config/conexao.php";

$controller = $_GET['controller'] ?? $_GET['modulo'] ?? 'inicio';
$action = $_GET['action'] ?? 'home';

switch ($controller) {
    case 'produto':
        require_once "../app/Controllers/ProdutoController.php";
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
        require_once "../app/Controllers/EstoqueController.php";
        $obj = new EstoqueController();
        if ($action === 'movimentar') {
            $obj->movimentar($pdo);
        } else {
            $obj->home_estoque($pdo);
        }
        break;
    case 'pdv':
        require_once "../app/Controllers/VendaController.php";
        $obj = new VendaController();
        if ($action === 'finalizar') {
            $obj->finalizar_venda($pdo);
        } else {
            $obj->home_pdv($pdo);
        }
        break;
    case 'vendas':
        require_once "../app/Controllers/VendaController.php";
        $obj = new VendaController();
        if ($action === 'detalhes') {
            $id = filter_input(
                INPUT_GET,
                'id',
                FILTER_VALIDATE_INT
            );

            $obj->detalhes_venda($pdo, $id);
        } else {
            $obj->listar_vendas($pdo);
        }
        break;
    case 'backup':
        require_once "../app/Controllers/BackupController.php";
        $obj = new BackupController();

        if ($action === 'gerar') {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit('Método não permitido.');
            }

            $obj->gerar_backup();
        } elseif ($action === 'baixar') {
            $obj->baixar_backup($_GET['arquivo'] ?? '');
        } elseif ($action === 'excluir') {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit('Método não permitido.');
            }

            $obj->excluir_backup($_POST['arquivo'] ?? '');
        } else {
            $obj->home_backup();
        }
        break;
    default:
        require_once "../app/views/home.php";
}