<?php
$backups = isset($backups) && is_array($backups) ? $backups : [];
$escape = static fn(mixed $value): string => htmlspecialchars(
    (string)($value ?? ''),
    ENT_QUOTES,
    'UTF-8'
);
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backups | Mercado+</title>
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
                <a href="index.php?controller=vendas&action=listar">◷ &nbsp; Vendas</a>
                <a class="active" href="index.php?controller=backup&action=home">⇩ &nbsp; Backups</a>
            </nav>
        </aside>

        <main class="main">
            <header class="topline">
                <div>
                    <p class="eyebrow">Manutenção</p>
                    <h1>Backups</h1>
                    <p class="muted">Gere e baixe cópias do banco de dados.</p>
                </div>
                <form method="post" action="index.php?controller=backup&action=gerar">
                    <button class="button" type="submit">Gerar backup</button>
                </form>
            </header>

            <?php if (!empty($mensagem)): ?>
                <div class="notice"><?= $escape($mensagem) ?></div>
            <?php endif; ?>

            <?php if (!empty($erro)): ?>
                <div class="notice error"><?= $escape($erro) ?></div>
            <?php endif; ?>

            <section class="panel">
                <div class="panel-head">
                    <h2>Arquivos disponíveis</h2>
                    <span class="muted"><?= count($backups) ?> arquivos</span>
                </div>

                <?php if (!$backups): ?>
                    <div class="empty">Nenhum backup foi criado ainda.</div>
                <?php else: ?>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Arquivo</th>
                                    <th>Tamanho</th>
                                    <th>Criado em</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($backups as $backup): ?>
                                    <tr>
                                        <td><strong><?= $escape($backup['nome']) ?></strong></td>
                                        <td><?= number_format((int) $backup['tamanho'], 0, ',', '.') ?> bytes</td>
                                        <td><?= $escape($backup['criado_em']) ?></td>
                                        <td>
                                            <a class="button light" href="index.php?controller=backup&action=baixar&arquivo=<?= rawurlencode($backup['nome']) ?>">Baixar</a>
                                            <form method="post" action="index.php?controller=backup&action=excluir" style="display:inline" onsubmit="return confirm('Excluir este backup?')">
                                                <input type="hidden" name="arquivo" value="<?= $escape($backup['nome']) ?>">
                                                <button class="button danger" type="submit">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>

</html>