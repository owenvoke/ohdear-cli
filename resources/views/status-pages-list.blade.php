@php /** @var list<OhDear\PhpSdk\Dto\StatusPage> $statusPage */ @endphp
<x-layouts.app>
    <table style="box">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status Summary</th>
                <th>Monitors</th>
            </tr>
        </thead>
        @forelse($statusPages as $statusPage)
            <tr>
                <td>
                    <span>{{ $statusPage->id }}</span>
                </td>
                <td>
                    <span>{{ $statusPage->title }}</span>
                </td>
                <td>
                    <span>{{ $statusPage->summarizedStatus }}</span>
                </td>
                <td>
                    <span>{{ implode(',', collect($statusPage->monitors)->map(fn (array $monitor) => $monitor['sort_url'])->toArray()) }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No monitors were found for the authenticated user.</td>
            </tr>
        @endforelse
    </table>
</x-layouts.app>
