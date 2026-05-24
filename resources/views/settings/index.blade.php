@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">System Settings</h1>
        <p class="text-gray-600 mt-2">Configure company information, employee ID format, and system preferences</p>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">✅ {{ $message }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg">
        @csrf
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Company Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'Birrama Inc.' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                    <select name="currency" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="ETB" {{ ($settings['currency'] ?? 'ETB') === 'ETB' ? 'selected' : '' }}>ETB (Ethiopian Birr)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">💾 Save Settings</button>
        </div>
    </form>
</div>
@endsection
