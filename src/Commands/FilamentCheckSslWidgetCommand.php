<?php

namespace Joaopaulolndev\FilamentCheckSslWidget\Commands;

use Illuminate\Console\Command;

class FilamentCheckSslWidgetCommand extends Command
{
    public $signature = 'filament-check-ssl-widget';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
