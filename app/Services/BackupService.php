<?php

class BackupService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function gerar(): array
    {
        $this->validarConfiguracao();
        $this->criarDiretorio();

        $nomeArquivo = sprintf(
            'backup_%s_%s.sql',
            $this->normalizarNome($this->config['banco']),
            date('Y-m-d_H-i-s')
        );

        $caminhoArquivo =
            rtrim($this->config['diretorio'], '/\\')
            . DIRECTORY_SEPARATOR
            . $nomeArquivo;

        $comando = $this->montarComando($caminhoArquivo);

        $saida = [];
        $codigoRetorno = 0;

        exec($comando . ' 2>&1', $saida, $codigoRetorno);

        if ($codigoRetorno !== 0) {
            if (is_file($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            throw new RuntimeException(
                'Não foi possível gerar o backup. Retorno: '
                . implode(' ', $saida)
            );
        }

        if (
            !is_file($caminhoArquivo)
            || filesize($caminhoArquivo) === 0
        ) {
            if (is_file($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            throw new RuntimeException(
                'O arquivo de backup não foi criado corretamente.'
            );
        }

        return [
            'nome' => $nomeArquivo,
            'caminho' => $caminhoArquivo,
            'tamanho' => filesize($caminhoArquivo)
        ];
    }

    public function excluirAntigos(): int
    {
        $diretorio = rtrim(
            $this->config['diretorio'],
            '/\\'
        );

        $dias = (int) ($this->config['retencao_dias'] ?? 30);

        if ($dias <= 0 || !is_dir($diretorio)) {
            return 0;
        }

        $limite = strtotime("-{$dias} days");
        $arquivos = glob($diretorio . '/*.sql');

        if ($arquivos === false) {
            return 0;
        }

        $quantidadeExcluida = 0;

        foreach ($arquivos as $arquivo) {
            if (
                is_file($arquivo)
                && filemtime($arquivo) < $limite
                && unlink($arquivo)
            ) {
                $quantidadeExcluida++;
            }
        }

        return $quantidadeExcluida;
    }

    private function montarComando(string $arquivo): string
    {
        $executavel = escapeshellarg(
            $this->config['mysqldump']
        );

        $host = escapeshellarg(
            $this->config['host']
        );

        $porta = escapeshellarg(
            $this->config['porta']
        );

        $usuario = escapeshellarg(
            $this->config['usuario']
        );

        $banco = escapeshellarg(
            $this->config['banco']
        );

        $destino = escapeshellarg($arquivo);

        /*
         * MYSQL_PWD evita colocar a senha diretamente no argumento -p.
         * Ainda é uma solução inicial, não a solução definitiva para produção.
         */
        $senha = escapeshellarg(
            $this->config['senha']
        );

        if (PHP_OS_FAMILY === 'Windows') {
            $prefixoSenha = 'set "MYSQL_PWD='
                . $this->config['senha']
                . '" && ';
        } else {
            $prefixoSenha = 'MYSQL_PWD=' . $senha . ' ';
        }

        return $prefixoSenha
            . $executavel
            . ' --host=' . $host
            . ' --port=' . $porta
            . ' --user=' . $usuario
            . ' --single-transaction'
            . ' --quick'
            . ' --routines'
            . ' --triggers'
            . ' --events'
            . ' --default-character-set=utf8mb4'
            . ' --no-tablespaces'
            . ' ' . $banco
            . ' > ' . $destino;
    }

    private function validarConfiguracao(): void
    {
        $campos = [
            'host',
            'porta',
            'banco',
            'usuario',
            'mysqldump',
            'diretorio'
        ];

        foreach ($campos as $campo) {
            if (
                !isset($this->config[$campo])
                || $this->config[$campo] === ''
            ) {
                throw new RuntimeException(
                    "Configuração de backup ausente: {$campo}"
                );
            }
        }

        $executavel = $this->config['mysqldump'];
        $temCaminho = strpbrk($executavel, '/\\') !== false;
        $encontrado = $temCaminho && is_file($executavel);

        if (!$temCaminho) {
            $saida = [];
            $codigoRetorno = 0;
            $comando = PHP_OS_FAMILY === 'Windows'
                ? 'where '
                : 'command -v ';

            exec(
                $comando . escapeshellarg($executavel),
                $saida,
                $codigoRetorno
            );
            $encontrado = $codigoRetorno === 0;
        }

        if (!$encontrado) {
            throw new RuntimeException(
                'O executável mysqldump não foi encontrado no caminho configurado.'
            );
        }
    }

    private function criarDiretorio(): void
    {
        $diretorio = $this->config['diretorio'];

        if (
            !is_dir($diretorio)
            && !mkdir($diretorio, 0750, true)
            && !is_dir($diretorio)
        ) {
            throw new RuntimeException(
                'Não foi possível criar o diretório de backups.'
            );
        }
    }

    private function normalizarNome(string $nome): string
    {
        return preg_replace(
            '/[^a-zA-Z0-9_-]/',
            '_',
            $nome
        ) ?? '';
    }
}