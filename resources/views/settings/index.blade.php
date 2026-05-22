<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        @foreach($settings as $key => $value)
                            <div class="mb-4">
                                <x-input-label for="{{ $key }}" :value="ucwords(str_replace('_', ' ', $key))" />
                                <x-text-input id="{{ $key }}" name="{{ $key }}" type="text" class="mt-1 block w-full" value="{{ $value }}" />
                            </div>
                        @endforeach
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
