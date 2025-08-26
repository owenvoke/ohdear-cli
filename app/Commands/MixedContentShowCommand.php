<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\Dto\MixedContent;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class MixedContentShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'mixed-content:show {monitor-id : The id of the monitor to view mixed content for}';

    /** @var string */
    protected $description = 'Display the mixed content for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $mixedContentList = collect($ohDear->mixedContent($this->argument('monitor-id')))
            ->mapToGroups(fn (MixedContent $mixedContent) => [$mixedContent->foundOnUrl => $mixedContent]);

        render(view('mixed-content-show', ['mixedContentList' => $mixedContentList]));
    }
}
