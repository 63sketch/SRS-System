<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Offboarding</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        @foreach($exits as $exit)<div>{{ $exit->employee->first_name }} - {{ $exit->status }}</div>@endforeach
    </div></div></div>
</x-app-layout>
