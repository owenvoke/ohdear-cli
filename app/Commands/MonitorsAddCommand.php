<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class MonitorsAddCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'monitors:add
                            {url : The URL or location that you want to monitor}
                            {--http : Create an HTTP monitor (default)}
                            {--ping : Create an ICMP ping monitor}
                            {--tcp : Create a TCP port monitor}
                            {--t|team= : The id of the team that the monitor should be added to}
                            {--c|checks=* : The list of checks that should be used, defaults to all checks}';

    /** @var string */
    protected $description = 'Add a new monitor to Oh Dear';

    /** {@inheritdoc} */
    protected $aliases = ['sites:add'];

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        if (! ($url = $this->argument('url'))) {
            $this->warn('A valid URL must be provided');

            return;
        }

        if (! ($teamId = $this->option('team')) || ! is_numeric($teamId)) {
            $this->warn('A valid team id must be provided');

            return;
        }

        $checks = $this->hasOption('checks') ? ['checks' => $this->option('checks')] : [];

        $type = match (true) {
            $this->option('ping') => 'ping',
            $this->option('tcp') => 'tcp',
            default => 'http',
        };

        $monitor = $ohDear->createMonitor(array_merge([
            'url' => $url,
            'type' => $type,
            'team_id' => $teamId,
        ], $checks));

        render(view('notice', ['notice' => "Created a new monitor with id {$monitor->id}"]));

        render(view('monitors-show', ['monitor' => $monitor, 'uptimePercentage' => 'N/A']));
    }
}
