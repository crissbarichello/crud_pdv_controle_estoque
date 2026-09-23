<?php
function vendasEsc(mixed $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

$vendas = isset($vendas) && is_array($vendas) ? $vendas : [];
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Vendas | Mercado+</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="shell">
        <aside class="sidebar">
            <div class="brand">mercado<span>+</span></div>
            <div class="nav-label">Operação</div>
            <nav class="nav">
                <a href="index.php">⌂ &nbsp; Visão geral</a>
                <a href="index.php?controller=produto">▦ &nbsp; Produtos</a>
                <a href="index.php?controller=estoque">↕ &nbsp; Estoque</a>
                <a href="index.php?controller=pdv">▣ &nbsp; Caixa / PDV</a>
                <a class="active" href="index.php?controller=vendas&action=listar">◷ &nbsp; Vendas</a>
                <a href="index.php?controller=backup&action=home">⇩ &nbsp; Backups </a>
            </nav>
        </aside>
        <main class="main">
            <header class="topline">
                <div>
                    <p class="eyebrow">Movimento do caixa</p>
                    <h1>Histórico de vendas</h1>
                    <p class="muted">Consulte as vendas finalizadas no terminal.</p>
                </div><a class="button" href="index.php?controller=pdv">Abrir caixa</a>
            </header>
            <section class="panel">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Venda</th>
                                <th>Data</th>
                                <th>Pagamento</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody><?php foreach ($vendas as $venda): ?><tr>
                                    <td><strong>#<?= (int)$venda['id'] ?></strong></td>
                                    <td><?= date('d/m/Y H:i', strtotime($venda['data_venda'])) ?></td>
                                    <td><?= vendasEsc($venda['forma_pagamento']) ?></td>
                                    <td><strong>R$ <?= number_format((float)$venda['total'], 2, ',', '.') ?></strong></td>
                                    <td><a class="button light" href="index.php?controller=vendas&action=detalhes&id=<?= (int)$venda['id'] ?>">Detalhes</a></td>
                                </tr><?php endforeach; ?></tbody>
                    </table><?php if (!$vendas): ?><div class="empty">Nenhuma venda registrada.</div><?php endif; ?>
                </div>
            </section>
        </main>
    </div>
</body>

</html>