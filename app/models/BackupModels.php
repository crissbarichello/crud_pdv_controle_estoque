<?php

class BackupModel
{
    private string $diretorio;

    public function __construct(string $diretorio)
    {
        $this->diretorio = rtrim($diretorio, '/\\');
    }

    public function buscarTodos(): array
    {
        if (!is_dir($this->diretorio)) {
            return [];
        }

        $arquivos = glob($this->diretorio . '/*.sql');

        if ($arquivos === false) {
            return [];
        }

        $backups = [];

        foreach ($arquivos as $arquivo) {
            $backups[] = [
                'nome' => basename($arquivo),
                'tamanho' => filesize($arquivo),
                'criado_em' => date(
                    'Y-m-d H:i:s',
                    filemtime($arquivo)
                )
            ];
        }

        usort($backups, function ($backupA, $backupB) {
            return strcmp(
                $backupB['criado_em'],
                $backupA['criado_em']
            );
        });

        return $backups;
    }

    public function buscarPorNome(string $nome): ?string
    {
        $nomeSeguro = basename($nome);
        $arquivo = $this->diretorio . '/' . $nomeSeguro;

        if (!is_file($arquivo)) {
            return null;
        }

        if (strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) !== 'sql') {
            return null;
        }

        return $arquivo;
    }

    public function excluir(string $nome): bool
    {
        $arquivo = $this->buscarPorNome($nome);

        if ($arquivo === null) {
            return false;
        }

        return unlink($arquivo);
    }
}