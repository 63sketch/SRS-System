<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Date</th>
                                <th scope="col" class="px-6 py-4">User</th>
                                <th scope="col" class="px-6 py-4">Action</th>
                                <th scope="col" class="px-6 py-4">Module</th>
                                <th scope="col" class="px-6 py-4">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auditLogs as $log)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4">{{ $log->created_at->format('d M Y H:i') }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $log->user->name ?? 'System' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $log->action === 'created' ? 'bg-green-100 text-green-800' : ($log->action === 'deleted' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ strtoupper($log->action) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $log->entity_type }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('audit-logs.show', $log) }}" class="text-blue-600 hover:text-blue-900">View Changes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $auditLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
