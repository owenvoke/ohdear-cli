@php /** @var OhDear\PhpSdk\Dto\StatusPageUpdate $statusPageUpdate */ @endphp
<x-layouts.app>
    <div>
        <span class="font-bold text-gray block">ID:</span> {{ $statusPageUpdate->id }}
        <span class="font-bold text-gray block">Title:</span> {{ $statusPageUpdate->title }}
        <span class="font-bold text-gray block">Severity:</span> {{ $statusPageUpdate->severity }}
        <span class="font-bold text-gray block">Pinned:</span> {{ $statusPageUpdate->pinned ? 'Yes' : 'No' }}
        <span class="font-bold text-gray block">Time:</span> {{ $statusPageUpdate->time }}
    </div>

    <pre class="mt-1">{{ $statusPageUpdate->text }}</pre>
</x-layouts.app>
