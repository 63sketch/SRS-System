<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Training Catalog</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        @foreach($trainings as $t)<div>{{ $t->title }} - {{ $t->provider }}</div>@endforeach
    </div></div></div>
</x-app-layout>
