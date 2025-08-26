<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class DnsHistoryShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'dns-history:show {monitor-id : The id of the monitor to access DNS history items for}
                                             {id : The id of the DNS history item to view}';

    /** @var string */
    protected $description = 'Display the latest performance details for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        render(view('dns-history-show', [
            'dnsHistoryItem' => $ohDear->dnsHistoryItem($this->argument('monitor-id'), $this->argument('id')),
        ]));
    }
}
