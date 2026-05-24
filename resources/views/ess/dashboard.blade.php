<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Self-Service Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Personal Info Card --}}
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">My Profile</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</div>
                        <div><strong>Code:</strong> {{ $employee->employee_code }}</div>
                        <div><strong>Department:</strong> {{ $employee->department->name ?? 'N/A' }}</div>
                        <div><strong>Position:</strong> {{ $employee->position->title ?? 'N/A' }}</div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('ess.documents') }}" class="text-blue-600 hover:underline">My Documents</a></li>
                        <li><a href="{{ route('ess.payslips') }}" class="text-blue-600 hover:underline">My Payslips</a></li>
                        <li><a href="{{ route('leave.index') }}" class="text-blue-600 hover:underline">Request Leave</a></li>
                    </ul>
                </div>

                {{-- Announcements --}}
                <div class="md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-bold mb-4">Recent Announcements</h3>
                    @forelse($announcements as $announcement)
                        <div class="mb-4 p-4 border-b">
                            <h4 class="font-semibold">{{ $announcement->title }}</h4>
                            <p class="text-sm text-gray-600">{{ $announcement->body }}</p>
                        </div>
                    @empty
                        <p>No recent announcements.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
