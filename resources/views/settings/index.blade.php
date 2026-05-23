<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Alert Messages --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    ✅ {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <strong>❌ Errors:</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg">
                @csrf
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Company Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="company_name" :value="__('Company Name')" />
                            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" value="{{ $settings['company_name'] ?? 'Birrama Inc.' }}" required />
                        </div>
                        <div>
                            <x-input-label for="currency" :value="__('Currency')" />
                            <select name="currency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="ETB" {{ ($settings['currency'] ?? 'ETB') === 'ETB' ? 'selected' : '' }}>ETB (Ethiopian Birr)</option>
                                <option value="USD" {{ ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' }}>USD (US Dollar)</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="timezone" :value="__('Timezone')" />
                            <x-text-input id="timezone" name="timezone" type="text" class="mt-1 block w-full" value="{{ $settings['timezone'] ?? 'Africa/Addis_Ababa' }}" required />
                        </div>
                    </div>
                </div>

                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Employee ID Configuration</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="employee_id_format" :value="__('ID Format Pattern')" />
                            <x-text-input id="employee_id_format" name="employee_id_format" type="text" class="mt-1 block w-full" value="{{ $settings['employee_id_format'] ?? 'EMP-{YYYY}-{0000}' }}" required />
                        </div>
                        <div>
                            <x-input-label for="employee_id_counter" :value="__('Next Employee ID Number')" />
                            <x-text-input id="employee_id_counter" name="employee_id_counter" type="number" class="mt-1 block w-full" value="{{ $settings['employee_id_counter'] ?? 1001 }}" required />
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <x-primary-button>
                        💾 {{ __('Save Settings') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
