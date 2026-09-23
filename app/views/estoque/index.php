<?php
$produtos = $produtos ?? [];
$movimentacoes = $movimentacoes ?? [];

function estoqueEsc(mixed $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
} ?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Estoque | Mercado+</title>
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
                <a class="active" href="index.php?controller=estoque">↕ &nbsp; Estoque</a>
                <a href="index.php?controller=pdv">▣ &nbsp; Caixa / PDV</a>
                <a href="index.php?controller=vendas&action=listar">◷ &nbsp; Vendas</a>
                <a href="index.php?controller=backup&action=home">⇩ &nbsp; Backups </a>
            </nav>
        </aside>
        <main class="main">
            <header class="topline">
                <div>
                    <p class="eyebrow">Inventário</p>
                    <h1>Controle de estoque</h1>
                    <p class="muted">Atualize saldos e acompanhe cada movimentação.</p>
                </div>
            </header>
            <section class="panel">
                <div class="panel-head">
                    <h2>Registrar movimentação</h2>
                </div>
                <form method="post" action="index.php?controller=estoque&action=movimentar">
                    <div class="form-grid">
                        <div class="field"><label for="produto_id">Produto</label><select id="produto_id" name="produto_id" required>
                                <option value="">Selecione um produto</option><?php foreach ($produtos as $produto): ?><option value="<?= (int)$produto['id'] ?>"><?= estoqueEsc($produto['descricao']) ?> · saldo <?= (int)$produto['estoque'] ?></option><?php endforeach; ?>
                            </select></div>
                        <div class="field"><label for="tipo">Tipo</label><select id="tipo" name="tipo">
                                <option value="ENTRADA">Entrada de mercadoria</option>
                                <option value="SAIDA">Saída / ajuste</option>
                            </select></div>
                        <div class="field"><label for="quantidade">Quantidade</label><input id="quantidade" name="quantidade" type="number" min="1" required></div>
                        <div class="field"><label for="observacao">Observação</label><input id="observacao" name="observacao" placeholder="Ex.: recebimento do fornecedor"></div>
                    </div>
                    <div class="form-actions"><button class="button" type="submit">Registrar movimentação</button></div>
                </form>
            </section>
            <section class="panel">
                <div class="panel-head">
                    <h2>Histórico recente</h2><span class="muted"><?= count($movimentacoes) ?> movimentações</span>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Produto</th>
                                <th>Tipo</th>
                                <th>Quantidade</th>
                                <th>Observação</th>
                            </tr>
                        </thead>
                        <tbody><?php foreach ($movimentacoes as $movimento): ?><tr>
                                    <td><?= date('d/m/Y H:i', strtotime($movimento['data_movimento'])) ?></td>
                                    <td><strong><?= estoqueEsc($movimento['descricao']) ?></strong></td>
                                    <td><span class="badge <?= $movimento['tipo'] === 'SAIDA' ? 'low' : '' ?>"><?= estoqueEsc($movimento['tipo']) ?></span></td>
                                    <td><?= (int)$movimento['quantidade'] ?></td>
                                    <td><?= estoqueEsc($movimento['observacao']) ?></td>
                                </tr><?php endforeach; ?></tbody>
                    </table><?php if (!$movimentacoes): ?><div class="empty">Nenhuma movimentação registrada.</div><?php endif; ?>
                </div>
            </section>
        </main>
    </div>
</body>

</html>