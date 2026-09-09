<?php

class BackupController
{
    public function gerar_backup()
    {
        $arquivo = "../backup/backup_" .
                   date("Ymd_His") .
                   ".sql";

        $comando =
            "mysqldump -u root -pSENHA db_pdv > $arquivo";

        exec($comando);

        header("Location: index.php");
        exit;
    }
}