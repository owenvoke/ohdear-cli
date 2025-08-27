<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class MonitorShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'monitor:show {id : The id of the monitor to view}';

    /** @var string */
    protected $description = 'Display a single monitor and its current status';

    /** {@inheritdoc} */
    protected $aliases = ['sites:show'];

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $monitor = $ohDear->monitor($this->argument('id'));

        render(view('monitor-show', ['monitor' => $monitor]));
    }
}
