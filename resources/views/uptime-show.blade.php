@php /** @var list<OhDear\PhpSdk\Dto\Uptime> $uptime */ @endphp
<x-layouts.app>
    <div class="underline">Uptime:</div>

    <ul>
        @forelse ($uptime as $entry)
            <li>
                <span class="font-bold text-gray">{{ $entry->datetime }}</span> ({{ $entry->uptimePercentage }}%)
            </li>
        @empty
            <li class="list-none">
                <span>No uptime entries were found for the specified monitor.</span>
            </li>
        @endforelse
    </ul>
</x-layouts.app>
