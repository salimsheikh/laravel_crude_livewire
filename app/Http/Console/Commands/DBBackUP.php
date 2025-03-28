<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;

class DBBackUP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dbbackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $backupPath = Storage::path("/backup/" . now()->format('Y-m-d-H-i-s') . ".sql");

        $mysqlDumpPath = "C:\wamp64\bin\mysql\mysql9.1.0\bin\mysqldump";

        $command = "\"$mysqlDumpPath\" --user=".env('DB_USERNAME').
        " --password=".env('DB_PASSWORD').
        " --host=".env('DB_HOST').
        " ".env('DB_DATABASE')." > \"$backupPath\"";

        $process = Process::run($command);

        if ($process->successful()) { // ✅ Use successful() method
            $this->info("Database backup saved as: " . basename($backupPath));
        } else {
            $this->error("Database backup failed: " . $process->errorOutput());
        }
    }
}
