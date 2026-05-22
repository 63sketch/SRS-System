<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 border rounded shadow">
                            <h3 class="font-bold text-lg mb-2">Employee Reports</h3>
                            <div class="flex gap-2">
                                <a href="{{ route('reports.employees.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded">Export XLSX</a>
                                <a href="{{ route('reports.employees.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded">Export PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
