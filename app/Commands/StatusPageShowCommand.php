<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class StatusPageShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'status-page:show {id : The id of the status page to view}';

    /** @var string */
    protected $description = 'Display a single status page and its details';

    /** {@inheritdoc} */
    protected $aliases = ['status-pages:show'];

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        render(view('status-page-show', ['statusPage' => $ohDear->statusPage($this->argument('id'))]));
    }
}
