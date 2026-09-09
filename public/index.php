<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PDV Sul</title>
    <?php

        require_once "config/database.php";
    ?>

</head>

<body>
    <?php

    echo "<h1>Bem-vindo ao Restaurante Bona Comida</h1>";
    //echo "<p>Aqui você encontra suas notas e frequências.</p>";

    // echo "Conectando ao banco: " . $host . " user: " . $user;
    echo "<h2>Painel Administrativo</h2>";


    
$controller = $_GET['controller'] ?? 'produto';
$action     = $_GET['action'] ?? 'home';

switch ($controller) {

    case 'produto':

        require_once "app/Controllers/ProdutoController.php";

        $obj = new ProdutoController();

        switch ($action) {

            case 'cadastrar':
                $obj->cadastrar_produto($pdo);
                break;

            case 'editar':
                $obj->home_produto(
                    $pdo,
                    $_GET['id']
                );
                break;

            case 'atualizar':
                $obj->atualizar_produto(
                    $pdo,
                    $_GET['id']
                );
                break;

            case 'excluir':
                $obj->excluir_produto(
                    $pdo,
                    $_GET['id']
                );
                break;

            default:
                $obj->home_produto($pdo);
        }

    break;
}

    echo "<h3>Lista de tabelas</h3>";
    $tabelas = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo '<ol>';
    foreach ($tabelas as $tabela) {
        echo '<li><a href="./' . $tabela . '.php">' . $tabela . '</a></li>';
    }
    echo '</ol>';

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