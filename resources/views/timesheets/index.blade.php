<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">My Timesheets</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        <a href="{{ route('timesheets.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">New Timesheet</a>
        <table class="min-w-full"><thead><tr><th>Week Start</th><th>Status</th><th>Submitted At</th></tr></thead><tbody>
            @foreach($timesheets as $ts)<tr><td>{{ $ts->week_start_date }}</td><td>{{ $ts->status }}</td><td>{{ $ts->submitted_at }}</td></tr>@endforeach
        </tbody></table>
    </div></div></div>
</x-app-layout>
