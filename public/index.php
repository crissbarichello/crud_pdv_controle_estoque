<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bona Comida</title>
    <?php
     require "../config/conexao.php"; // Puxa a conexão pronta

    // require '../app/Models/UsuarioModel.php';
   // require '../app/Models/ProdutoModel.php';

    // $usuarioModel = new UsuarioModel($pdo);

    // $produtos = new ProdutoModel($pdo);

    // // // // insert no banco
    // //     $usuario = $usuarioModel->inserir("Fabio", "fabio@email.com", "senha123");
    // //     print_r($usuario);


    // // // select no banco 
    // $usuarios = $usuarioModel->ler();
    // $produtos = $produtos->ler();



    #require "../conexao.php";                       // precisa deixar $pdo pronto
    require "../app/Controllers/UsuarioController.php";
    require "../app/Controllers/ProdutoController.php";

   


    // Agora você já pode usar a variável $pdo aqui embaixo...
    ?>

</head>

<body>
    <?php

    echo "<h1>Bem-vindo ao Restaurante Bona Comida</h1>";
    //echo "<p>Aqui você encontra suas notas e frequências.</p>";

    // echo "Conectando ao banco: " . $host . " user: " . $user;
    echo "<h2>Painel Administrativo</h2>";


    // $controller_produto = new ProdutoController();
    // $acao_produto = $_GET['acao_produto'] ?? 'home_produto';
    // $id_produto = $_GET['id_produto'] ?? null;

    // switch ($acao_produto) {
    //     case 'cadastrar':
    //         $controller_produto->cadastrar_produto($pdo);
    //         break;
    //     case 'atualizar':
    //         $controller_produto->atualizar_produto($pdo, $id_produto);
    //         break;
    //     case 'excluir':
    //         $controller_produto->excluir_produto($pdo, $id_produto);
    //         break;
    //     default:
    //         $controller_produto->home_produto($pdo, $id_produto); // lista + form (vazio ou preenchido se veio ?id=)
    // }
    $modulo = $_GET['modulo'] ?? 'usuario';
    $acao = $_GET['acao'] ?? 'home';


    // $controller = new UsuarioController();
    // $acao_usuario = $_GET['acao_usuario'] ?? 'home';
    // $id_usuario = $_GET['id_usuario'] ?? null;

    // switch ($acao_usuario) {
    //     case 'cadastrar':
    //         $controller->cadastrar($pdo);
    //         break;
    //     case 'atualizar':
    //         $controller->atualizar($pdo, $id_usuario);
    //         break;
    //     case 'excluir':
    //         $controller->excluir($pdo, $id_usuario);
    //         break;
    //     default:
    //         $controller->home($pdo, $id_usuario); // lista + form (vazio ou preenchido se veio ?id=)
    // }

    switch ($modulo) {

    case 'produto':
        $controller = new ProdutoController();

        switch ($acao) {
            case 'cadastrar':
                $controller->cadastrar_produto($pdo);
                break;
            case 'atualizar':
                $controller->atualizar_produto($pdo, $_GET['id'] ?? null);
                break;
            case 'excluir':
                $controller->excluir_produto($pdo, $_GET['id'] ?? null);
                break;
            default:
                $controller->home_produto($pdo);
        }
        break;

    case 'usuario':
    default:
        $controller = new UsuarioController();

        switch ($acao) {
            case 'cadastrar':
                $controller->cadastrar($pdo);
                break;
            case 'atualizar':
                $controller->atualizar($pdo, $_GET['id'] ?? null);
                break;
            case 'excluir':
                $controller->excluir($pdo, $_GET['id'] ?? null);
                break;
            default:
                $controller->home($pdo);
        }
}

    // echo "<h3>Lista de tabelas</h3>";
    // $tabelas = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    // echo '<ol>';
    // foreach ($tabelas as $tabela) {
    //     echo '<li><a href="./' . $tabela . '.php">' . $tabela . '</a></li>';
    // }
    // echo '</ol>';

    // if (count($produtos) > 0) {

    //     echo "<table border='1'>";
    //     echo "<tr>
    //         <th>ID</th>
    //         <th>Nome</th>
    //         <th>Preço</th>
    //         <th>Categoria</th>
    //       </tr>";

    //     foreach ($produtos as $row) {

    //         echo "<tr>";
    //         echo "<td>" . $row['id'] . "</td>";
    //         echo "<td>" . $row['nome'] . "</td>";
    //         echo "<td>" . $row['preco'] . "</td>";
    //         echo "<td>" . $row['categoria'] . "</td>";
    //         echo "</tr>";
    //     }

    //     echo "</table>";
    // } else {
    //     echo "0 resultados";
    // }


    // //     // Exibe a lista completa de usuários formatada na tela
    // echo "<pre>";
    // print_r($usuarios);
    // echo "</pre>";


    //$pdo = null;
    ?>
</body>

</html>