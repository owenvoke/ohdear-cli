<x-layouts.app>
    <div>
        <span class="font-bold text-gray block">ID:</span> {{ $monitor->id }}
        <span class="font-bold text-gray block">URL:</span> {{ $monitor->url }}
        <span class="font-bold text-gray block">Status Summary:</span> {{ $monitor->attributes['summarized_check_result'] }}
        <span class="font-bold text-gray block">Last Run At:</span> {{ $monitor->attributes['latest_run_date'] }}
        <span class="font-bold text-gray block">Uptime in last 24hrs:</span> {{ $uptimePercentage ?? 'N/A' }}
    </div>

    <div class="underline mt-1">Checks:</div>

    <ul>
        @forelse ($monitor->checks as $check)
            <li>
                <span class="font-bold text-gray capitalize">{{ $check->label }}</span> ({{ $check->enabled ? 'Enabled' : 'Disabled' }})
            </li>
        @empty
            <li class="list-none">
                <span>No checks were found for the specified monitor.</span>
            </li>
        @endforelse
    </ul>
</x-layouts.app>
