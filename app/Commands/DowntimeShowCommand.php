<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use Carbon\Carbon;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class DowntimeShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'downtime:show {monitor-id : The id of the monitor to view downtime for}
                                          {start-date? : The date to start at}
                                          {end-date? : The date to end at}
                                          {--limit=10 : The number of downtime records to show}';

    /** @var string */
    protected $description = 'Display the recent downtime for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        if (! $startDate = $this->argument('start-date')) {
            $startDate = Carbon::yesterday()->format('Y-m-d H:i:s');
        }

        if (! $endDate = $this->argument('end-date')) {
            $endDate = now()->format('Y-m-d H:i:s');
        }

        $downtime = collect($ohDear->downtime($this->argument('monitor-id'), $startDate, $endDate))
            ->take((int) $this->option('limit'));

        render(view('downtime-show', ['downtime' => $downtime]));
    }
}
