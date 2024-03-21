<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class HostingerDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hostinger-deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for deployment in hostinger';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!file_exists('.env') && file_exists('.env.example')) {
            if ($this->confirm('Do you want to copy .env.example to a .env file', true)) {
                $process = new Process(['cp .env.example .env']);
                $process->run();
                if ($process->isSuccessful()) {
                    $this->line('.env copied as the example');
                } else {
                    $this->error($process->getErrorOutput());
                }

            }
        }

        if ($this->confirm('Do you want to create the symbolic public folder to public_html?', true)) {
            $process = new Process(['ln -s public public_html']);
            $process->run();
            if ($process->isSuccessful()) {
                $this->line('directorio simbolico creado');
            }
        }
        if ($this->confirm('Do you want to migrate de database?', true)) {
            $migrationsOptions = [];

            if ($this->confirm('Do you want to seed the database?', true)) {
                array_push($migrationsOptions, '--seed');
            }
            $this->call('migrate:fresh', $migrationsOptions);

        }

    }
}
