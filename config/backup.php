<?php

return [
    'host' => 'localhost',
    'porta' => '3306',
    'banco' => 'db_pdv',
    'usuario' => 'root',
    'senha' => '',

    /*
     * Laragon normalmente possui o mysqldump dentro de:
     *
     * C:/laragon/bin/mysql/mysql-8.x.x-winx64/bin/mysqldump.exe
     *
     * Ajuste o caminho de acordo com a versão instalada.
     */
    'mysqldump' => getenv('MYSQLDUMP_PATH') ?: 'C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqldump.exe',

    'diretorio' => dirname(__DIR__) . '/storage/backups',

    // Quantidade *e dias para manter arquivos antigo*.
    'retencao_dias' => 30
];