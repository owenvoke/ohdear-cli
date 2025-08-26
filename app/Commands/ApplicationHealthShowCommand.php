<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class ApplicationHealthShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'application-health:show {monitor-id : The id of the monitor to view application health for}';

    /** @var string */
    protected $description = 'Display the application health for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        render(view('application-health-show', [
            'applicationHealthChecks' => $ohDear->applicationHealthChecks($this->argument('monitor-id')),
        ]));
    }
}
