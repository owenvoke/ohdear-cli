<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class StatusPageUpdateDeleteCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'status-page-update:delete
                            {id : The id of the status page update that you want to delete}';

    /** @var string */
    protected $description = 'Delete a status page update';

    /** {@inheritdoc} */
    protected $aliases = ['status-page-updates:delete'];

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $ohDear->deleteStatusPageUpdate($this->argument('id'));

        render(view('notice', [
            'notice' => "Removed the status page update with id {$this->argument('id')}",
        ]));
    }
}
