@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Reports & Analytics</h1>
        <p class="text-gray-600 mt-2">Export employee, leave, benefits, and document data</p>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Employee Report</h2>
            </div>
            <p class="text-gray-600 mb-4">Export all employee records with details</p>
            <div class="flex gap-2">
                <a href="{{ route('reports.employees.excel') }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center">📊 Excel</a>
                <a href="{{ route('reports.employees.pdf') }}" class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-center">📄 PDF</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Leave Summary</h2>
            </div>
            <p class="text-gray-600 mb-4">Leave taken, balance, and approval status</p>
            <a href="{{ route('reports.leave.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">📊 Export Excel</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Benefits Summary</h2>
            </div>
            <p class="text-gray-600 mb-4">Employee benefits assignment and tracking</p>
            <a href="{{ route('reports.benefits.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">📊 Export Excel</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Document Expiry</h2>
            </div>
            <p class="text-gray-600 mb-4">Track expiring employee documents</p>
            <a href="{{ route('reports.expiry.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">📊 Export Excel</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Headcount Report</h2>
            </div>
            <p class="text-gray-600 mb-4">Total employees by department and status</p>
            <a href="{{ route('reports.headcount.excel') }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded text-center block">📊 View Report</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Audit Logs</h2>
            </div>
            <p class="text-gray-600 mb-4">View all system actions and changes</p>
            <a href="{{ route('audit-logs.index') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded text-center block">📋 View Logs</a>
        </div>
    </div>
</div>
@endsection
