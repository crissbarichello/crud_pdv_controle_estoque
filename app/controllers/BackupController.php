<?php

require_once __DIR__ . '/../Models/BackupModels.php';
require_once __DIR__ . '/../Services/BackupService.php';

class BackupController
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__
            . '/../../config/backup.php';
    }

    public function home_backup(): void
    {
        $model = new BackupModel(
            $this->config['diretorio']
        );

        $backups = $model->buscarTodos();

        $mensagem = $_SESSION['mensagem'] ?? null;
        $erro = $_SESSION['erro'] ?? null;

        unset($_SESSION['mensagem'], $_SESSION['erro']);

        require __DIR__
            . '/../views/backups/index.php';
    }

    public function gerar_backup(): void
    {
        try {
            $service = new BackupService($this->config);

            $backup = $service->gerar();
            $service->excluirAntigos();

            $_SESSION['mensagem'] =
                'Backup gerado com sucesso: '
                . $backup['nome'];
        } catch (Throwable $erro) {
            error_log($erro->getMessage());

            $_SESSION['erro'] =
                'Não foi possível gerar o backup. '
                . $erro->getMessage();
        }

        $this->redirecionar();
    }

    public function baixar_backup(string $nome): void
    {
        $model = new BackupModel(
            $this->config['diretorio']
        );

        $arquivo = $model->buscarPorNome($nome);

        if ($arquivo === null) {
            http_response_code(404);
            exit('Arquivo de backup não encontrado.');
        }

        header('Content-Type: application/sql');
        header(
            'Content-Disposition: attachment; filename="'
            . basename($arquivo)
            . '"'
        );
        header('Content-Length: ' . filesize($arquivo));
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: no-store, no-cache, must-revalidate');

        readfile($arquivo);
        exit;
    }

    public function excluir_backup(string $nome): void
    {
        try {
            $model = new BackupModel(
                $this->config['diretorio']
            );

            if (!$model->excluir($nome)) {
                throw new RuntimeException(
                    'Arquivo não encontrado.'
                );
            }

            $_SESSION['mensagem'] =
                'Backup excluído com sucesso.';
        } catch (Throwable $erro) {
            error_log($erro->getMessage());

            $_SESSION['erro'] =
                'Não foi possível excluir o backup.';
        }

        $this->redirecionar();
    }

    private function redirecionar(): void
    {
        header(
            'Location: index.php?controller=backup&action=home'
        );

        exit;
    }
}