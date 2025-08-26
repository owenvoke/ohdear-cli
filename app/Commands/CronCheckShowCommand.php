<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class CronCheckShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'cron-check:show {monitor-id : The id of the monitor to view cron checks for}';

    /** @var string */
    protected $description = 'Display the cron checks for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        render(view('cron-check-show', ['cronChecks' => $ohDear->cronCheckDefinitions($this->argument('monitor-id'))]));
    }
}
