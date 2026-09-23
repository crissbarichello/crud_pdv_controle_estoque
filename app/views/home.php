<?php $base = 'index.php'; ?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mercado Central | Painel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="shell">
        <aside class="sidebar">
            <div class="brand">mercado<span>+</span></div>
            <div class="nav-label">Operação</div>
            <nav class="nav">
                <a class="active" href="index.php">⌂ &nbsp; Visão geral</a>
                <a href="index.php?controller=produto">▦ &nbsp; Produtos</a>
                <a href="index.php?controller=estoque">↕ &nbsp; Estoque</a>
                <a href="index.php?controller=pdv">▣ &nbsp; Caixa / PDV</a>
                <a href="index.php?controller=vendas&action=listar">◷ &nbsp; Vendas</a>
                <a href="index.php?controller=backup&action=home">⇩ &nbsp; Backups </a>
            </nav>
            <div class="sidebar-foot">Terminal 01 · Operação aberta</div>
        </aside>
        <main class="main">
            <header class="topline">
                <div>
                    <p class="eyebrow">Painel do supermercado</p>
                    <h1>Bom dia, operador.</h1>
                    <p class="muted">Escolha uma área para começar a trabalhar.</p>
                </div><span class="badge">● Sistema online</span>
            </header>
            <section class="grid"><a class="module" href="index.php?controller=produto">
                    <div class="module-icon">▦</div>
                    <div>
                        <h2>Produtos</h2>
                        <p>Cadastre itens, preços, custos e acompanhe o saldo disponível.</p>
                    </div><span class="button light">Abrir cadastro →</span>
                </a><a class="module" href="index.php?controller=estoque">
                    <div class="module-icon">↕</div>
                    <div>
                        <h2>Controle de estoque</h2>
                        <p>Registre entradas e saídas e veja o histórico de movimentações.</p>
                    </div><span class="button light">Abrir estoque →</span>
                </a><a class="module" href="index.php?controller=pdv">
                    <div class="module-icon">▣</div>
                    <div>
                        <h2>Caixa / PDV</h2>
                        <p>Monte o carrinho, receba o pagamento e dê baixa automática no estoque.</p>
                    </div><span class="button">Abrir caixa →</span>
                </a><a class="module" href="index.php?controller=vendas&action=listar">
                    <div class="module-icon">◷</div>
                    <div>
                        <h2>Histórico de vendas</h2>
                        <p>Consulte as vendas registradas e seus totais.</p>
                    </div><span class="button light">Ver vendas →</span>
                </a><a class="module" href="index.php?controller=backup&action=home">
                    <div class="module-icon">⇩</div>
                    <div>
                        <h2>Backups</h2>
                        <p>Consulte e gerencie os backups do sistema.</p>
                    </div><span class="button light">Ver backups →</span>
                </a></section>

        </main>
    </div>
</body>

</html>