@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Reports & Analytics</h1>
        <p class="text-gray-600 mt-2">Export employee, leave, benefits, and document data</p>
    </div>

    {{-- Alert Messages --}}
    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    {{-- Reports Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Employee Reports --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Employee Report</h2>
                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                </svg>
            </div>
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

        {{-- Leave Reports --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Leave Summary</h2>
                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path>
                </svg>
            </div>
            <p class="text-gray-600 mb-4">Leave taken, balance, and approval status</p>
            <a href="{{ route('reports.leave.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">
                📊 Export Excel
            </a>
        </div>

        {{-- Benefits Reports --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Benefits Summary</h2>
                <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3.707 1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L5 2.586 3.707 1.293zM9 3a1 1 0 00-1 1v10a1 1 0 102 0V4a1 1 0 00-1-1zm5.707-1.293a1 1 0 00-1.414 1.414L12.586 2l-1.293 1.293a1 1 0 101.414 1.414l2-2a1 1 0 000-1.414l-2-2zM9 13a1 1 0 00-1 1v2a1 1 0 102 0v-2a1 1 0 00-1-1zm5.707-5.707a1 1 0 00-1.414 0L12 8.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 000-1.414z"></path>
                </svg>
            </div>
            <p class="text-gray-600 mb-4">Employee benefits assignment and tracking</p>
            <a href="{{ route('reports.benefits.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">
                📊 Export Excel
            </a>
        </div>

        {{-- Document Expiry Reports --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Document Expiry</h2>
                <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                </svg>
            </div>
            <p class="text-gray-600 mb-4">Track expiring employee documents</p>
            <a href="{{ route('reports.expiry.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">
                📊 Export Excel
            </a>
        </div>

        {{-- Headcount Report --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Headcount Report</h2>
                <svg class="w-8 h-8 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.5 1.5H5.75a.75.75 0 00-.75.75V4c0 .414.336.75.75.75h4.75a.75.75 0 00.75-.75V2.25a.75.75 0 00-.75-.75zm-3 9a3 3 0 11-6 0 3 3 0 016 0zm9-9a3 3 0 11-6 0 3 3 0 016 0zM18 12.75c0-.414-.336-.75-.75-.75h-3.5a.75.75 0 00-.75.75v1.5c0 .414.336.75.75.75h3.5a.75.75 0 00.75-.75v-1.5z"></path>
                </svg>
            </div>
            <p class="text-gray-600 mb-4">Total employees by department and status</p>
            <a href="{{ route('reports.headcount.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">
                📊 View Report
            </a>
        </div>

        {{-- Audit Logs --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Audit Logs</h2>
                <svg class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-gray-600 mb-4">View all system actions and changes</p>
            <a href="{{ route('audit-logs.index') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded text-center block">
                📋 View Logs
            </a>
        </div>

    </div>

    {{-- Export History --}}
    <div class="mt-12 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Exports</h2>
        <p class="text-gray-600 mb-4">Last 10 export operations (All exports are automatically logged in Audit Logs)</p>
        <div class="bg-blue-50 border border-blue-200 rounded p-4 text-blue-800">
            ℹ️ All export operations are tracked in the <strong>Audit Logs</strong> for compliance and security purposes.
        </div>
    </div>

</div>
@endsection
