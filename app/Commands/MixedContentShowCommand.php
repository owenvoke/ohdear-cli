<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use Illuminate\Support\Collection;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Resources\MixedContentItem;

class MixedContentShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'mixed-content:show {site-id : The id of the site to view mixed content for}';

    /** @var string */
    protected $description = 'Display the mixed content for a site';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        $mixedContents = $ohDear->mixedContent($this->argument('site-id'));

        if (empty($mixedContents)) {
            $this->line('Unable to find any mixed content for the specified site');

            return;
        }

        collect($mixedContents)->mapToGroups(function (MixedContentItem $mixedContent) {
            return [$mixedContent->foundOnUrl => $mixedContent];
        })->each(function (Collection $mixedContentItems, string $key) {
            $this->info($key);

            $this->output->listing(
                $mixedContentItems->map(static function (MixedContentItem $item) {
                    return "({$item->elementName}) {$item->mixedContentUrl}";
                })->toArray()
            );
        });
    }
}
