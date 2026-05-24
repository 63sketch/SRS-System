<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Payroll Runs</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        <table class="min-w-full"><thead><tr><th>Period</th><th>Status</th><th>Gross</th><th>Net</th></tr></thead><tbody>
            @foreach($runs as $run)<tr><td>{{ $run->period_month }}</td><td>{{ $run->status }}</td><td>{{ $run->total_gross }}</td><td>{{ $run->total_net }}</td></tr>@endforeach
        </tbody></table>
    </div></div></div>
</x-app-layout>
