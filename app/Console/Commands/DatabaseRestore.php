<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseRestore extends Command
{
    // Command name and signature
    protected $signature = 'db:restore {path}';

    // Command description
    protected $description = 'Restore the database from a SQL backup file';

    public function handle()
    {
        $path = $this->argument('path');

        if (!file_exists($path)) {
            $this->error("Backup file not found: $path");
            return 1;
        }

        // Get DB credentials from .env
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbPort = env('DB_PORT', '3306');
        $dbName = env('DB_DATABASE', 'homestead');
        $dbUser = env('DB_USERNAME', 'root');
        $dbPass = env('DB_PASSWORD', '');

        // Path to mysql.exe (adjust if using Laragon)
        // $mysqlPath = "C:\\xampp\\mysql\\bin\\mysql.exe";
        $mysqlPath = "C:\\laragon\\bin\\mysql\\mysql-8.4.3-winx64\\bin\\mysql.exe";

        // Construct the restore command
        $command = "\"$mysqlPath\" -h $dbHost -P $dbPort -u $dbUser " . ($dbPass ? "-p\"$dbPass\"" : "") . " $dbName < \"$path\"";

        try {
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                $this->error("Database restore failed. Return code: $returnVar");
                return 1;
            }

            $this->info("Database restored successfully from $path");
            return 0;

        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }
    }
}
