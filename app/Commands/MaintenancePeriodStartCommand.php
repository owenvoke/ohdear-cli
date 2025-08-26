<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class MaintenancePeriodStartCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'maintenance-period:start
                            {monitor-id : The id of the monitor that you want to create a maintenance period for}
                            {seconds : The maintenance period in seconds}';

    /** @var string */
    protected $description = 'Start a new maintenance period for a monitor from the current time';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $seconds = $this->argument('seconds');

        if (! $seconds || ! is_numeric($seconds)) {
            $this->warn('A valid number of seconds must be provided');

            return;
        }

        $maintenancePeriod = $ohDear->startMaintenancePeriod($this->argument('monitor-id'), (int) $seconds);

        render(view('notice', ['notice' => "Started a new maintenance period with id {$maintenancePeriod->id}"]));

        render(view('maintenance-period-show', ['maintenancePeriods' => [$maintenancePeriod]]));
    }
}
