<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports & Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Alert Messages --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ $message }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Employee Reports --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Employee Report</h3>
                    <p class="text-gray-600 mb-4">Export all employee records with details</p>
                    <div class="flex gap-2">
                        <a href="{{ route('reports.employees.excel') }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center">
                            📊 Excel
                        </a>
                        <a href="{{ route('reports.employees.pdf') }}" class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-center">
                            📄 PDF
                        </a>
                    </div>
                </div>

                {{-- Audit Logs --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Audit Logs</h3>
                    <p class="text-gray-600 mb-4">View all system actions and changes</p>
                    <a href="{{ route('audit-logs.index') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded text-center block">
                        📋 View Logs
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
