@php /** @var list<OhDear\PhpSdk\Dto\MaintenancePeriod> $maintenancePeriods */ @endphp
<x-layouts.app>
    <div class="underline">Maintenance Periods:</div>

    <ul>
        @forelse($maintenancePeriods as $maintenancePeriod)
            <li>
                <span class="font-bold text-gray">{{ $maintenancePeriod->id }}</span> (monitor: {{ $maintenancePeriod->monitorId }}) ({{ $maintenancePeriod->startsAt }} to {{ $maintenancePeriod->endsAt }})
            </li>
        @empty
            <li class="list-none">
                <span>No maintenance periods were found for the specified monitor.</span>
            </li>
        @endforelse
    </ul>
</x-layouts.app>
