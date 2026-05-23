<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Log Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('audit-logs.index') }}" class="text-blue-600 hover:text-blue-900">← Back to Logs</a>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div><strong>User:</strong> {{ $auditLog->user->name ?? 'System' }}</div>
                    <div><strong>Action:</strong> {{ strtoupper($auditLog->action) }}</div>
                    <div><strong>Module:</strong> {{ $auditLog->entity_type }} (#{{ $auditLog->entity_id }})</div>
                    <div><strong>Date:</strong> {{ $auditLog->created_at->format('d F Y H:i:s') }}</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-bold mb-2">Before</h3>
                        <pre class="bg-gray-100 p-4 rounded text-xs overflow-x-auto">{{ json_encode(json_decode($auditLog->before_json), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2">After</h3>
                        <pre class="bg-gray-100 p-4 rounded text-xs overflow-x-auto">{{ json_encode(json_decode($auditLog->after_json), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
