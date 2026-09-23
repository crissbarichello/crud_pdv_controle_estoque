<?php
$venda = isset($venda) && is_array($venda) ? $venda : [];
$itens = isset($itens) && is_array($itens) ? $itens : [];

function detalheEsc(mixed $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
} ?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Venda #<?= (int)$venda['id'] ?> | Mercado+</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="main">
        <header class="topline">
            <div>
                <p class="eyebrow">Comprovante</p>
                <h1>Venda #<?= (int)$venda['id'] ?></h1>
                <p class="muted"><?= detalheEsc($venda['forma_pagamento']) ?> · <?= date('d/m/Y H:i', strtotime($venda['data_venda'])) ?></p>
            </div><a class="button light" href="index.php?controller=vendas&action=listar">Voltar</a>
        </header>
        <section class="panel">
            <div class="panel-head">
                <h2>Itens da venda</h2>
                <span class="muted"><?= count($itens) ?> itens</span>
            </div>
            <?php if (!$itens): ?>
                <div class="empty">Esta venda não possui itens registrados.</div>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor unitário</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itens as $item): ?>
                                <tr>
                                    <td><strong><?= detalheEsc($item['descricao']) ?></strong></td>
                                    <td><?= (int)$item['quantidade'] ?></td>
                                    <td>R$ <?= number_format((float)$item['valor_unitario'], 2, ',', '.') ?></td>
                                    <td>R$ <?= number_format((float)$item['subtotal'], 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <div class="total"><span>Total da venda</span><span>R$ <?= number_format((float)$venda['total'], 2, ',', '.') ?></span></div>
        </section>
    </main>
</body>

</html>