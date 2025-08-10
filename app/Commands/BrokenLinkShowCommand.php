<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\Dto\BrokenLink;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class BrokenLinkShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'broken-link:show {monitor-id : The id of the site to view broken links for}';

    /** @var string */
    protected $description = 'Display the broken links for a site';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $brokenLinkList = collect($ohDear->brokenLinks($this->argument('monitor-id')))
            ->mapToGroups(fn (BrokenLink $brokenLink) => [$brokenLink->foundOnUrl => $brokenLink]);

        render(view('broken-link-show', ['brokenLinkList' => $brokenLinkList]));
    }
}
