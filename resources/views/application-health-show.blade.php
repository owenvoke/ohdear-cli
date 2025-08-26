@php /** @var list<OhDear\PhpSdk\Dto\ApplicationHealthCheck> $applicationHealthChecks */ @endphp
<x-layouts.app>
    <div class="underline mt-1">Application Health:</div>

    <ul>
        @forelse ($applicationHealthChecks as $check)
            <li>
                <span class="font-bold text-gray">{{ $check->label }}</span>
                ({{ $check->status }}) @if($check->message) - {{ $check->message }}@endif
            </li>
        @empty
            <li class="list-none">
                <span>No application checks were found for the specified monitor.</span>
            </li>
        @endforelse
    </ul>
</x-layouts.app>
