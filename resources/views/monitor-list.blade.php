@php /** @var list<OhDear\PhpSdk\Dto\Monitor> $monitors */ @endphp
<x-layouts.app>
    <table style="box">
        <thead>
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Status Summary</th>
                <th>Last Checked</th>
            </tr>
        </thead>
        @forelse($monitors as $monitor)
            <tr>
                <td>
                    <span>{{ $monitor->id }}</span>
                </td>
                <td>
                    <a href="{{ $monitor->url }}">{{ $monitor->url }}</a>
                </td>
                <td>
                    <span>{{ $monitor->summarizedCheckResult }}</span>
                </td>
                <td>
                    <span>{{ $monitor->latestRunDate }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No monitors were found for the authenticated user.</td>
            </tr>
        @endforelse
    </table>
</x-layouts.app>
