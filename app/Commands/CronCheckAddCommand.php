<?php

namespace App\Commands;

use App\Commands\Concerns\EnsureHasToken;
use LaravelZero\Framework\Commands\Command;
use OhDear\PhpSdk\Enums\CronType;
use OhDear\PhpSdk\OhDear;

use function Termwind\render;

class CronCheckAddCommand extends Command
{
    use EnsureHasToken;

    /** @var string */
    protected $signature = 'cron-check:add
                            {monitor-id : The id of the monitor that you want to create a cron check for}
                            {name : The name of the cron check}
                            {frequency-or-expression : The frequency of the cron check in minutes, or cron expression}
                            {--grace-time=5 : The grace time in minutes}
                            {--description= : The description for the cron check}
                            {--timezone=UTC : The timezone of your server}';

    /** @var string */
    protected $description = 'Add a new cron check for a monitor';

    public function handle(OhDear $ohDear)
    {
        if (! $this->ensureHasToken()) {
            return 1;
        }

        if (! $name = $this->argument('name')) {
            $this->warn('A valid name must be provided');

            return;
        }

        $cronCheck = match (true) {
            is_numeric($this->argument('frequency-or-expression')) => $ohDear->createCronCheckDefinition(
                $this->argument('monitor-id'),
                [
                    'name' => $name,
                    'type' => CronType::Simple,
                    'frequency_in_minutes' => (int) $this->argument('frequency-or-expression'),
                    'grace_time_in_minutes' => (int) $this->option('grace-time'),
                    'description' => $this->option('description') ?? '',
                ],
            ),
            default => $ohDear->createCronCheckDefinition(
                $this->argument('monitor-id'),
                [
                    'name' => $name,
                    'type' => CronType::Cron,
                    'frequency_in_minutes' => (int) $this->argument('frequency-or-expression'),
                    'grace_time_in_minutes' => (int) $this->option('grace-time'),
                    'description' => $this->option('description') ?? '',
                    'timezone' => $this->option('timezone'),
                ],
            )
        };

        $schedule = $cronCheck->cronExpression ?: "every {$cronCheck->frequencyInMinutes} minutes";

        render(view('notice', [
            'notice' => "{$cronCheck->name} (schedule: {$schedule}, grace time: {$cronCheck->graceTimeInMinutes} minutes) (ping url: {$cronCheck->pingUrl})",
        ]));
    }
}
