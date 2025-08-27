<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use Carbon\Carbon;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\Enums\UptimeSplit;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class UptimeShowCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'uptime:show {monitor-id : The id of the monitor to view uptime for}
                                        {start-date? : The date to start at}
                                        {end-date? : The date to end at}
                                        {--limit=10 : The number of uptime records to show}
                                        {--timeframe=hour : The timeframe to query data by (hour, day, month)}';

    /** @var string */
    protected $description = 'Display the recent uptime for a monitor';

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

        $timeframe = $this->timeframeToSplit($this->option('timeframe'));

        $uptime = $ohDear->uptime($this->argument('monitor-id'), $startDate, $endDate, $timeframe);

        render(view('uptime-show', ['uptime' => collect($uptime)->take((int) $this->option('limit'))]));
    }

    private function timeframeToSplit(mixed $timeframe): UptimeSplit
    {
        return match ($timeframe) {
            'month' => UptimeSplit::Month,
            'day' => UptimeSplit::Day,
            default => UptimeSplit::Hour,
        };
    }
}
