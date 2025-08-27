<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class StatusPageListCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'status-page:list';

    /** @var string */
    protected $description = 'Display a list of status pages and their summary';

    /** {@inheritdoc} */
    protected $aliases = ['status-pages:list'];

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        render(view('status-page-list', ['statusPages' => $ohDear->statusPages()]));
    }
}
