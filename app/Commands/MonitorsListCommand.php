<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class MonitorsListCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'monitors:list';

    /** @var string */
    protected $description = 'Display a list of monitors and their current status';

    /** {@inheritdoc} */
    protected $aliases = ['sites:list'];

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        render(view('sites-list', ['sites' => $ohDear->monitors()]));
    }
}
