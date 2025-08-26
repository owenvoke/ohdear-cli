<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class MaintenancePeriodStopCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'maintenance-period:stop
                            {monitor-id : The id of the monitor that you want to stop the maintenance period for}';

    /** @var string */
    protected $description = 'Stop the current maintenance period for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $ohDear->stopMaintenancePeriod($this->argument('monitor-id'));

        render(view('notice', ['notice' => "Stopped the current maintenance period for monitor with id {$this->argument('monitor-id')}"]));
    }
}
