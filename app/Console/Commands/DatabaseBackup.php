<?php

namespace App\Console\Commands;

use App\Database_Backup;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup'; // now you run: php artisan db:backup

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database and save to storage + log in backup_database table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = config('database.connections.mysql');
        $database   = $connection['database'];
        $username   = $connection['username'];
        $password   = $connection['password'];
        $host       = $connection['host'];

        $filename = "backup_" . Carbon::now()->format('Y_m_d_His') . ".sql";
        $storagePath = storage_path("app/backups");

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $filePath = $storagePath . '/' . $filename;

        // ✅ Use the full path to mysqldump
        $dumpPath = "C:\\xampp\\mysql\\bin\\mysqldump.exe";

        // Handle empty password case
        if ($password) {
            $command = "\"{$dumpPath}\" --user={$username} --password={$password} --host={$host} {$database} > \"{$filePath}\"";
        } else {
            $command = "\"{$dumpPath}\" --user={$username} --host={$host} {$database} > \"{$filePath}\"";
        }

        $returnVar = NULL;
        $output    = NULL;

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            // ✅ Save to database table
            Database_Backup::create([
                'filename' => $filename,
                'path'     => $filePath,
            ]);

            $this->info("✅ Database backup successful! Saved at: {$filePath}");
        } else {
            $this->error("❌ Database backup failed.");
        }
    }

}
